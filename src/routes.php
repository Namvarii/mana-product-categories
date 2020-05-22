<?php

    use Illuminate\Support\Facades\Route;

    $adminConfig = [
        'prefix'=>'manage',
        'namespace' => 'ManaCMS\ManaProductCategories\Http\Controllers\Admin',
        'as' => 'manage.',
        'middleware' => ['web','auth','admin'],
    ];

    Route::group($adminConfig,function () {
        Route::resource('productcategory', 'CategoryController')->except('show');
    });
