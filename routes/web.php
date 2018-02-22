<?php

$this->group(['middleware' => 'auth', 'namespace'=> 'Admin'], function(){
    Route::get('admin', 'AdminController@index');

    //Rota para mostra o saldo do usuário logado.
    Route::get('admin/balance', 'SaldoController@index')->name('admin.balance');
    //Rota para deposito. 
    Route::get('balance/deposit', 'SaldoController@deposit')->name('balance.deposit');
    Route::post('balance/store', 'SaldoController@store')->name('balance.store');
    //Rota para saque. 
    Route::get('balance/sake', 'SaldoController@cashOut')->name('balance.sake');
    Route::post('balance/CashOut', 'SaldoController@getCashOut')->name('balance.CashOut');
    //Rota para transferência de saldo 
    Route::get('balance/transfer', 'SaldoController@transfer')->name('balance.transfer');
    Route::post('transfer', 'SaldoController@confirTransfer')->name('transfer.register');
    Route::post('confirm/transfer', 'SaldoController@storeTransfer')->name('confirm.transfer');
    //Rota de mostra o historico
    Route::get('admin/historic', 'SaldoController@getHistoric')->name('admin.historic');
    
    Route::post('admin/historic', 'SaldoController@exbirFiltro')->name('admin.filtro');
});

Route::get('/', 'Site\SiteController@index');

Auth::routes();


