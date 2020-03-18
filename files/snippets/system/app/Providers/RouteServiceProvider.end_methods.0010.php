    /**
     * Define the "htmldb" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapHTMLDBRoutes()
    {
        Route::prefix('htmldb')
             ->middleware(App\Http\Middleware\HTMLDBMiddleware::class)
             ->namespace('App\Http\Controllers\HTMLDB')
             ->group(base_path('routes/htmldb.php'));
    }
