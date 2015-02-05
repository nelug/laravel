<?php

class BaseModel extends Eloquent {

    protected $rules = array();
    protected $errors;

/**
 * [_create description]
 * @return el mensaje
 * funcion para crear registros de cualquier formulario sin master details
 */
    public function _create()
    {
        $class = get_class($this);//funcion para capturar el nombre del modelo ejecuto la funcion
        $path = "App\\Validators\\{$class}Validator";
        $v = $path::make();

        if ($v->fails())
        {
            $this->errors = $v->messages();
            return false;
        }

        $values = array_map('trim', Input::all());
        $values = preg_replace('/\s{2,}/', ' ', $values);
        $values = array_map('ucfirst', $values);
        $class::create($values);
        return 'success';
    }

/**
 * [_update description]
 * @return mensaje
 * funcion para actualizar registros de cualquier formulario sin master details
 */
    public function _update()
    {
        $class = get_class($this);//funcion para capturar el nombre del modelo ejecuto la funcion
        $path = "App\\Validators\\{$class}Validator";

        $v = $path::make();
        if ($v->fails())
        {
            $this->errors = $v->messages();
            return false;
        }
    
        if (Input::has('password'))
        {
            $values = ( array_map('trim', Input::all()) );
        }
        else
        {
            $values = ( array_map('trim', Input::except('password')) );
        }

        $class::find(Input::get('id'))->update($values);
        return 'success';
    }
    
/**
 * [errors description]
 * @return error
 * funcion para retornar el error
 */
    public function errors()
    {
        return $this->errors->first();
    }
}
