<?php namespace App\Validators;

use ValidatorAssistant, Input;

class ProductoValidator extends ValidatorAssistant
{

    protected $rules = array(
        'codigo'        =>  'required|min:3|max:20|unique:productos,codigo, {id}',
        'descripcion'   =>  'required|min:10',
        'precio'        =>  'required|numeric',
    );

    protected function before()
    {
    	if (Input::has('id'))
    	{
            $this->bind('id', Input::get('id'));
    	}
    }
}
