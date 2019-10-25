<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin', 'Controller@index')->name('indexAdmin');
Route::get('admin/gammes', 'Api\GammeController@index')->name('indexGammes');
Route::post('admin/gammes/ajouter', 'Api\GammeController@store')->name('ajouterGamme');
Route::get('admin/gammes/{id}/modifier', 'Api\GammeController@edit')->name('modifierGamme');
Route::get('admin/gammes/{id}/supprimer', 'Api\GammeController@destroy')->name('supprimerGamme');
Route::post('admin/gammes/{id}/update', 'Api\GammeController@update')->name('updateGamme');

Route::get('admin/categories', 'Api\CategorieController@index')->name('indexCategories');
Route::post('admin/categories/ajouter', 'Api\CategorieController@store')->name('ajouterCategorie');
Route::get('admin/categories/{id}/modifier', 'Api\CategorieController@edit')->name('modifierCategorie');
Route::get('admin/categories/{id}/supprimer', 'Api\CategorieController@destroy')->name('supprimerCategorie');
Route::post('admin/categories/{id}/update', 'Api\CategorieController@update')->name('updateCategorie');

Route::get('admin/produits', 'Api\ProduitController@index')->name('indexProduits');
Route::post('admin/produits/ajouter', 'Api\ProduitController@store')->name('ajouterProduit');
Route::get('admin/produits/{id}/details', 'Api\ProduitController@show')->name('detailsProduit');
Route::get('admin/produits/{id}/modifier', 'Api\ProduitController@edit')->name('modifierProduit');
Route::get('admin/produits/{id}/supprimer', 'Api\ProduitController@destroy')->name('supprimerProduit');
Route::post('admin/produits/{id}/update', 'Api\ProduitController@update')->name('updateProduit');

Route::get('admin/partenaires', 'Api\PartenaireController@index')->name('indexPartenaires');
Route::post('admin/partenaires/ajouter', 'Api\PartenaireController@store')->name('ajouterPartenaire');
Route::get('admin/partenaires/{id}/modifier', 'Api\PartenaireController@edit')->name('modifierPartenaire');
Route::get('admin/partenaires/{id}/supprimer', 'Api\PartenaireController@destroy')->name('supprimerPartenaire');
Route::post('admin/partenaires/{id}/update', 'Api\PartenaireController@update')->name('updatePartenaire');

Route::get('admin/gallerie/images', 'Api\ImageController@index')->name('indexImages');
Route::post('admin/images/ajouter', 'Api\ImageController@store')->name('ajouterImage');
Route::get('admin/images/{id}/supprimer', 'Api\ImageController@destroy')->name('supprimerImage');

Route::get('admin/gallerie/videos', 'Api\VideoController@index')->name('indexVideos');
Route::post('admin/videos/ajouter', 'Api\VideoController@store')->name('ajouterVideo');
Route::get('admin/videos/{id}/modifier', 'Api\VideoController@edit')->name('modifierVideo');
Route::get('admin/videos/{id}/supprimer', 'Api\VideoController@destroy')->name('supprimerVideo');
Route::post('admin/videos/{id}/update', 'Api\VideoController@update')->name('updateVideo');

Route::get('admin/parametres', 'Api\ParametreController@index')->name('indexParametres');
Route::post('admin/parametres/ajouter', 'Api\ParametreController@store')->name('ajouterParametre');
Route::get('admin/parametres/{id}/modifier', 'Api\ParametreController@edit')->name('modifierParametre');
Route::get('admin/parametres/{id}/supprimer', 'Api\ParametreController@destroy')->name('supprimerParametre');
Route::post('admin/parametres/{id}/update', 'Api\ParametreController@update')->name('updateParametre');

Route::get('admin/annonces', 'Api\AnnonceController@index')->name('indexAnnonces');
Route::post('admin/annonces/ajouter', 'Api\AnnonceController@store')->name('ajouterAnnonce');
Route::get('admin/annonces/{id}/modifier', 'Api\AnnonceController@edit')->name('modifierAnnonce');
Route::get('admin/annonces/{id}/supprimer', 'Api\AnnonceController@destroy')->name('supprimerAnnonce');
Route::post('admin/annonces/{id}/update', 'Api\AnnonceController@update')->name('updateAnnonce');


Route::get('admin/pages', 'Api\PageController@index')->name('indexPages');
Route::post('admin/pages/ajouter', 'Api\PageController@store')->name('ajouterPage');
Route::get('admin/pages/{id}/modifier', 'Api\PageController@edit')->name('modifierPage');
Route::get('admin/pages/{id}/supprimer', 'Api\PageController@destroy')->name('supprimerPage');
Route::post('admin/pages/{id}/update', 'Api\PageController@update')->name('updatePage');

Route::get('admin/commandes', 'Api\CommandeController@index')->name('indexCommandes');
Route::get('admin/commandes/{id}/valider', 'Api\CommandeController@validateCommande')->name('validerCommande');
Route::get('admin/commandes/{id}/supprimer', 'Api\CommandeController@destroy')->name('supprimerCommande');

Route::get('admin/messages', 'Api\MessageController@index')->name('indexMessages');
Route::get('admin/messages/{id}/supprimer', 'Api\MessageController@destroy')->name('supprimerMessage');

Route::get('/', 'Controller@indexVisitor')->name('indexVisitor');

Route::post('recherche/produit', 'ProduitController@rechercher')->name('rechercherProduit');
Route::get('produits/{id}/details', 'ProduitController@details')->name('dProduit');
Route::get('produit/{id}/commander', 'ProduitController@commander')->name('commanderProduit');
Route::post('produi/{id}/commander', 'ProduitController@commanderProccessing')->name('commanderProccessing');

Route::get('messages', 'MessageController@index')->name('messages');
Route::post('messages/envoyer', 'Api\MessageController@store')->name('envoyerMessage');

Route::get('categories/{id}/produits', 'CategorieProduitController@categorie')->name('categorie');
Route::get('page/{id}/', 'Controller@page')->name('page');
