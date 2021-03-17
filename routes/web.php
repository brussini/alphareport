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

Route::get('/', function () {
    return redirect(route('home'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/homesticket', 'HomeSticketsController@index')->name('homesticket');
Route::get('/testhome', 'HomeController@test')->name('testhome');

Route::get('/import_excel', 'ImportExcelController@index');
Route::post('/import_excel/import', 'ImportExcelController@store');

Route::get('/import_sticket', 'ImportSticketController@index');
Route::post('/import_sticket/import', 'ImportSticketController@store');

Route::get('/testhome', 'TestController@index');
Route::get('/chartjs', 'TestController@Chartjs');

Route::get('chartjs', 'OticketshowController@chartjs');

Route::get('filter/downloadPDF', 'OticketshowController@downloadPDF');
Route::resource('filter', 'OticketshowController');

Route::resource('customsearch', 'CustomSearchController');
Route::resource('search_sticket', 'SearchSticketsController');

Route::get('display/datap1encoursPlainte', 'DisplayTicketsController@getdatap1encoursPlainte');
Route::get('display/datap2encoursPlainte', 'DisplayTicketsController@getdatap2encoursPlainte');
Route::get('display/datap3encoursPlainte', 'DisplayTicketsController@getdatap3encoursPlainte');
Route::get('display/datap4encoursPlainte', 'DisplayTicketsController@getdatap4encoursPlainte');


Route::get('display/datap1encoursInci', 'DisplayTicketsController@getdatap1encoursInci');
Route::get('display/datap2encoursInci', 'DisplayTicketsController@getdatap2encoursInci');
Route::get('display/datap3encoursInci', 'DisplayTicketsController@getdatap3encoursInci');
Route::get('display/datap4encoursInci', 'DisplayTicketsController@getdatap4encoursInci');

Route::get('display/datap2encours', 'DisplayTicketsController@getdatap2encours');
Route::get('display/datap2clos', 'DisplayTicketsController@getdatap2clos');
Route::get('display/datap3encours', 'DisplayTicketsController@getdatap3encours');
Route::get('display/datap1clos', 'DisplayTicketsController@getdatap1clos');
Route::get('display/datap4encours', 'DisplayTicketsController@getdatap4encours');
Route::get('display/dataclosprtableau', 'DisplayTicketsController@getdataclosprtableau');
Route::get('display/dataAvisdeprob', 'DisplayTicketsController@getdatapAvisdeProb');

Route::get('display/datavalideStandardANO', 'ShowSticketController@getdataValideStandardANO');
Route::get('display/datavalideStandardOCM', 'ShowSticketController@getdataValideStandardOCM');
Route::get('display/datatermineStandardANO', 'ShowSticketController@getdataTermineStandardANO');
Route::get('display/datatermineStandardOCM', 'ShowSticketController@getdataTermineStandardOCM');
Route::get('display/dataprepastandardANO', 'ShowSticketController@getdataPrepareStandardANO');
Route::get('display/dataprepastandardOCM', 'ShowSticketController@getdataPrepareStandardOCM');
Route::get('display/dataencoursnormalOCM', 'ShowSticketController@getdataEncoursNormalOCM');
Route::get('display/dataencoursstandardOCM', 'ShowSticketController@getdataEncoursStandardOCM');
Route::get('display/dataprisstandardOCM', 'ShowSticketController@getdataPrisStandardOCM');
Route::get('display/dataprisnormalOCM', 'ShowSticketController@getdataPrisNormalOCM');

Route::get('display/datatermine', 'ShowSticketController@getdataTermine');
Route::get('display/databilan', 'ShowSticketController@getdataBilan');
Route::get('display/dataprepare', 'ShowSticketController@getdataPrepare');
Route::get('display/datainitialise', 'ShowSticketController@getdataInitialise');
Route::get('display/dataencours', 'ShowSticketController@getdataEncours');

Route::get('chart-line', 'HomeSticketsController@index');
Route::get('chart-line-ajax', 'HomeSticketsController@chartLineAjax');



