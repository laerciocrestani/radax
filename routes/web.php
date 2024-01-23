<?php

Route::get('/',  array('uses' => 'IndexController@index'));
Route::get('/a-radax', function(){
    return view('a-radax');
});
Route::get('/fale-conosco', function(){
    return view('fale-conosco');
});
Route::get('/catalogo-virtual', function(){
    return view('catalogo-virtual');
});
Route::get('/lgpd', function(){
    return view('lgpd');
});
Route::get('/produtos',  array('uses' => 'IndexController@all_produtos'))->name('all_produtos');
Route::get('/produtos/{categoria}',  array('uses' => 'IndexController@produtos'))->name('produtos');
Route::get('/produto/{categoria}/{produto}*{slug}', 'IndexController@produto')->name('produto');
Route::get('/orcamento/add/{categoria}/{codalt}', 'IndexController@orcamento_add')->name('orcamento-add');
Route::get('/orcamento/remover/{codalt}', 'IndexController@orcamento_remover')->name('orcamento-remover');
Route::get('/orcamento/atualizar/{codalt}/{qtd}', 'IndexController@orcamento_atualizar')->name('orcamento-atualizar');


Route::get('/orcamento', 'IndexController@orcamento')->name('orcamento');

Route::post('/orcamento/enviar', 'IndexController@orcamento_enviar')->name('orcamento.enviar');


Route::post('/localizar', 'IndexController@localizar')->name('localizar');


//Importação
Route::get('/importacao', 'ImportacaoController@produtos');
