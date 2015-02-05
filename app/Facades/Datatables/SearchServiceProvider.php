<?php namespace App\Facades\Datatables;

use Illuminate\Support\ServiceProvider, Input;

class SearchServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register 'searchcontroller' instance container to our SearchController object
        $this->app['searchtable'] = $this->app->share(function($app)
        {
            return new SearchTable;
        });
    }
}
