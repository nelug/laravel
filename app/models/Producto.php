<?php

use \NEkman\ModelLogger\Contract\Logable;

class Producto extends \BaseModel implements Logable {
	
	protected $table = 'productos';

	protected $guarded = array('id');

	protected $fillable = [];

	public function ventadetalle()
    {
        return $this->hasMany('venta_id');
    }

	public function getLogName() 
	{
		return $this->codigo;
	}

}