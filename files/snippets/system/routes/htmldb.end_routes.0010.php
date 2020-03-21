
Route::prefix('adminlte')->group(function () {
    Route::prefix('login')->group(function () {
	    Route::get('/get', 'AdminLTE/LoginController@getHTMLDB');
    });
});