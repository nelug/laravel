<?php namespace App\Facades\Datatables;

use Illuminate\Support\Facades\Facade;

class SearchController extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {

       return 'searchtable';
       
    }

}
