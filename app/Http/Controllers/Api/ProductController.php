<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;



class ProductController extends Controller
{
    
    // metodo index per selezionare il prodotto, caricare in cache i dati e 
    // reindirizzare alla pagina del primo item

    public function index($categoryId, $productId){

        // Preparo la uri per la riuchesta api 
        $apiUri = ApiController::getApiUri() . '/product-info';

        $productCardCache = $productId;
        
        // Se non gia memorizzata in cache e non trascorso il tempo stabilito effettuo una chiamata alla api
        // andando a prelevare il modello di prodotto indicato nella uri di richiesta, 
        // tralascio la selezione di lingua e moneta inserendoli manualmente
        $productModel = cache()->remember($productCardCache, 60*60*4, function() use ($apiUri, $productId) {
            return Http::withToken(ApiController::getToken())->get($apiUri, [
                'code' => $productId,
                'language' => 'it',
                'iso_code_2' => 'IT',
                'currency' => 'EUR'
            ])->object()->response;
        });


        // vado a iterare gli items trovati nel modello prodotto
        $productItems = [];
       foreach($productModel->items as $item){
        
            // se non gia presente in cache vado ad effettuare una richiesta api per prelevare i dati degli items del prodotto
            $skuCache = $item->sku;
            $productItem = cache()->remember($skuCache, 60*60*4, function() use ($item) {
                return Http::withToken(ApiController::getToken())->get($item->details_endpoint)->object()->response;
            });

            // mi creo un array con item del prodotto e il suo codice sku
            $productItems[] = ['item' => $productItem, 'sku' => $item->sku];

       }

       // salvo l'array di items nella cache se non gia presente
       cache()->remember($productId. '-items', 60*60*4, function() use ($productItems){
            return $productItems;
       });

       // faccio un redirect al primo item del prodotto
       return redirect('/categories/'. $categoryId . '/products/' . $productId . '/' . $productModel->items[0]->sku);

    }



    // metodo show per visualizzare la scheda prodotto

    public function show($categoryId, $productId, $sku) {

        // prelevo dalla cache il modello del prodotto e l'array con i suoi items
        $productModel = Cache::get($productId);
        $productItems = Cache::get($productId . '-items');
       
        // itero l'array di items per selezionare quello che corrisponde al codice sku nella uri di richiesta
        foreach($productItems as $item){
            if($item['sku'] == $sku){

                // una volta individuato il giusto item invio le variabili al file item.blade 
                // per la visualizzazione della scheda prodotto
                return view('item', [
                        'item' => $item,
                        'items' => $productItems,
                        'model' => $productModel
                    ]);

            }
        }
        
    }


}
