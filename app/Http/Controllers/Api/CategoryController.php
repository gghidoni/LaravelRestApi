<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;



class CategoryController extends Controller
{


    // metodo index per visualizzare la lista di tutte le categorie

    public function index($lang){
    
        // Preparo la uri per la riuchesta api
        $apiUri = ApiController::getApiUri() . '/categories';
    
        // Se la richiesta delle categorie non è gia stata memorizzata nella cache e se non è passato 
        // il tempo indicato allora effettuo una nuova richiesta api per le categorie
        
        $categories = cache()->remember('categories-list-' . $lang, 60*60*24, function() use ($apiUri, $lang) {
            return Http::withToken(ApiController::getToken())->get($apiUri, [
                'language' => $lang
            ])->object();
        });

        $currentUri = 'categories';

        // richiamo il file categories.blade e gli passo come variabile la lista delle categorie
        return view('categories', [
            'categories' => $categories->response,
            'language' => $lang,
            'uri' => $currentUri
        ]);

    }


    // metodo show per visualizzare la singola categoria

    public function show($lang, $categoryId){

        // verifico se i dati sono salvati nella cache, altrimenti effettuo una nuova chiamata api
        // utile per il cambio di lingua

        if(Cache::has('categories-list-' . $lang)){

        // richiamo la lista delle categorie dalla cache
        $categories = Cache::get('categories-list-' . $lang)->response;

        } else {

            // Preparo la uri per la riuchesta api
            $apiUri = ApiController::getApiUri() . '/categories';

            $categories = cache()->remember('categories-list-' . $lang, 60*60*24, function() use ($apiUri, $lang) {
                return Http::withToken(ApiController::getToken())->get($apiUri, [
                    'language' => $lang
                ])->object();
            });

        }
        
        
        // seleziono esclusivamente la categoria corrispondente all id della uri
        foreach($categories as $category){
            if($category->category_id == $categoryId){

                $currentUri = 'categories/' . $categoryId;

                return view('category', [
                    'category' => $category,
                    'language' => $lang,
                    'uri' => $currentUri
                ]);

            }
        }
    }
}
