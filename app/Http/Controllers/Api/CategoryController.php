<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;



class CategoryController extends Controller
{


    // metodo index per visualizzare la lista di tutte le categorie

    public function index(){
    
        // Preparo la uri per la riuchesta api
        $apiUri = ApiController::getApiUri() . '/categories';
    
        // Se la richiesta delle categorie non è gia stata memorizzata nella cache e se non è passato 
        // indicato allora effettuo una nuova richiesta api per le categorie
        // tralascio la selezione della lingua inserendola maualmente
        $categories = cache()->remember('categories-list', 60*60*24, function() use ($apiUri) {
            return Http::withToken(ApiController::getToken())->get($apiUri, [
                'language' => 'it'
            ])->object();
        });

        // richiamo il file categories.blade e gli passo come variabile la lista delle categorie
        return view('categories', [
            'categories' => $categories->response
        ]);

    }


    // metodo show per visualizzare la singola categoria

    public function show($categoryId){

        // richiamo la lista delle categorie dalla cache
        $categories = Cache::get('categories-list')->response;
        
        // seleziono esclusivamente la categoria corrispondente all id della uri
        foreach($categories as $category){
            if($category->category_id == $categoryId){

                return view('category', [
                    'category' => $category
                ]);

            }
        }
    }
}
