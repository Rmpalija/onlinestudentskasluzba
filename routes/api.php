<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('ispitis', 'IspitisController', ['except' => ['create', 'edit']]);

        Route::resource('fakultetis', 'FakultetisController', ['except' => ['create', 'edit']]);

        Route::resource('predmetis', 'PredmetisController', ['except' => ['create', 'edit']]);

        Route::resource('studentis', 'StudentisController', ['except' => ['create', 'edit']]);

        Route::resource('skolarinas', 'SkolarinasController', ['except' => ['create', 'edit']]);

});
