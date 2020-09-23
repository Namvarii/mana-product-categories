<?php

    use Illuminate\Support\Facades\Route;

    $adminConfig = [
        'prefix'=>'manage',
        'namespace' => 'ManaCMS\ManaProductCategories\Http\Controllers\Admin',
        'as' => 'manage.',
        'middleware' => ['web','auth','admin'],
    ];

    Route::group($adminConfig,function () {
        Route::resource('productcategory', 'ProductCategoryController')->except('show');

        Route::group(['prefix'=>'batch','as'=>'batch.'],function(){
            Route::get('productcategory', 'CategoryBatchController@create')->name('productcategory.create');
            Route::patch('productcategory', 'CategoryBatchController@store')->name('productcategory.store');
            Route::get('productcategory/export','CategoryBatchController@export')->name('productcategory.export');
        });

    });
