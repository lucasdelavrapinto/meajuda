<?php

// route to show the login form
Route::get('/', array('as' => 'index','uses' => 'HomeController@showWelcome'));
Route::get('/busca-lancamento', array('as' => 'bus.lan','uses' => 'HomeController@buscaLancamentos'));
Route::get('/get-lan', array('as' => 'get.lan','uses' => 'HomeController@getLancament'));

Route::post('/cadastra-lancamento', array('as' => 'cad.lan','uses' => 'HomeController@cadastrarLancamento'));
Route::post('/altera-data', array('as' => 'alt.dat','uses' => 'HomeController@alteraData'));

Route::any('deleta-lancamento/{id}', array('as' => 'del.lan', 'uses' => 'HomeController@deletaLancamento'));


Route::post('/cadastra-conta', array('as' => 'cad.con','uses' => 'HomeController@cadastrarConta'));

Route::any('/deletar-lancamentos/todos', array('as' => 'del.all','uses' => 'HomeController@deletarLancamentosAll'));
Route::any('/deletar-contas/todos', array('as' => 'del.all','uses' => 'HomeController@deletarContasAll'));

