<?php

use Illuminate\Http\Request;

/*
    DEBUT ROUTES AUTHENTIFICATION
*/

Route::post('register', 'Api\PassportController@register');
Route::post('login', 'Api\PassportController@login');

/*
    DEBUT ROUTES AUTHENTIFICATION
*/
    Route::get('/users/admin', 'Api\UserController@userAdmin');

    Route::resource('/users', 'Api\UserController');
    Route::post('/users/exists', 'Api\UserController@exists');
    Route::post('/users/{id}/updatePhoto', 'Api\UserController@updatePhoto');

/*
        DEBUT ROUTES CRUD GAMME PRODUITS
    */
    Route::get('gammes', 'Api\GammeController@index');
    Route::post('gammes/store', 'Api\GammeController@store');
    Route::get('gammes/{id}/details', 'Api\GammeController@show');
    Route::put('gammes/{id}/update', 'Api\GammeController@update');
    Route::delete('gammes/{id}/delete', 'Api\GammeController@destroy');
    /*
        FIN ROUTES CRUD GAMME PRODUIT
    */
    /*====================================================================*/
    /*
        DEBUT ROUTES CRUD CATEGORIE PRODUITS
    */
    Route::get('categories', 'Api\CategorieController@index');
    Route::post('categories/store', 'Api\CategorieController@store');
    Route::get('categories/{id}/details', 'Api\CategorieController@show');
    Route::put('categories/{id}/update', 'Api\CategorieController@update');
    Route::delete('categories/{id}/delete', 'Api\CategorieController@destroy');
    /*
        FIN ROUTES CRUD CATEGORIE PRODUITS
    */
    /*====================================================================*/

    /*
        DEBUT ROUTES CRUD PRODUITS
    */

    Route::get('partenaires', 'Api\PartenaireController@index');
    Route::post('partenaires', 'Api\PartenaireController@store');
    Route::get('partenaires/{id}', 'Api\PartenaireController@show');
    Route::put('partenaires/{id}', 'Api\PartenaireController@update');
    Route::post('partenaires/{id}/update', 'Api\PartenaireController@update');
    Route::delete('partenaires/{id}/delete', 'Api\PartenaireController@destroy');
    /*
        FIN ROUTES CRUD PRODUITS
    */
    /*====================================================================*/

    /*
        DEBUT ROUTES CRUD PRODUITS
    */
    Route::get('produits', 'Api\ProduitController@index');
    Route::post('produits/store', 'Api\ProduitController@store');
    Route::get('produits/{id}/details', 'Api\ProduitController@show');
    Route::post('produits/{id}/update', 'Api\ProduitController@update');
    Route::delete('produits/{id}/delete', 'Api\ProduitController@destroy');
    /*
        FIN ROUTES CRUD PRODUITS
    */

    /*
        DEBUT ROUTES MESSAGES
    */
    Route::get('messages', 'Api\MessageController@index');
    Route::post('messages/store', 'Api\MessageController@store');
    Route::get('messages/{id}', 'Api\MessageController@show');
    Route::delete('messages/{id}/delete', 'Api\MessageController@destroy');
    Route::put('messages/{id}/answer', 'Api\MessageController@sendMessage');
    /*
        FIN ROUTES MESSAGE
    */


    // Page
    Route::resource('annonces', 'Api\AnnonceController');

    // Page
    Route::resource('pages', 'Api\PageController');
    Route::post('pages/{id}/update', 'Api\PageController@update');
    Route::get('pages/{id}/lignes', 'Api\PageController@ligne');
    Route::post('pages/{id}/lignes', 'Api\PageController@addLigne');

    Route::resource('lignePages', 'Api\LignePageController');



    // Video
    Route::resource('videos', 'Api\VideoController');


    // CategorieImage
    Route::resource('categorieImages', 'Api\CategorieImageController');


    // Image
    Route::resource('images', 'Api\ImageController');
    Route::post('images/{id}/update', 'Api\ImageController@update');

    // Parametre
    Route::resource('parametres', 'Api\ParametreController');

    //commande
    Route::get('commandes/uVList', 'Api\CommandeController@uVList');
    Route::delete('commandes/{id}', 'Api\CommandeController@delete');
    Route::get('commandes/vList', 'Api\CommandeController@vList');
    Route::put('commandes/{id}/validate', 'Api\CommandeController@validateCommande');

    Route::get('statistiques/generalCount', 'Api\StatistiqueController@generalCount');
    Route::get('statistiques/nombreDeCategorieCommande', 'Api\StatistiqueController@nombreDeCategorieCommande');
    Route::get('statistiques/nombreDeGammeCommande', 'Api\StatistiqueController@nombreDeGammeCommande');


Route::middleware('auth:api')->group(function () {

});
