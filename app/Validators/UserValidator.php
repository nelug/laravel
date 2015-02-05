<?php namespace App\Validators;

use ValidatorAssistant, Input;

class UserValidator extends ValidatorAssistant
{

    protected $rules = array(
        'username'        =>  'required|min:3|max:20|unique:users,username, {id}',
        'nombre'          =>  'required|min:4',
        'apellido'        =>  'required|min:4',
        'email'           =>  'required|email|unique:users,email, {id}',
        'password'        =>  'min:3|max:10',
    );

    protected function before()
    {
    	if (Input::has('id'))
    	{
            $this->bind('id', Input::get('id'));
    	}
    }
}
