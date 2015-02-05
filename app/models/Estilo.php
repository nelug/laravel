<?php
use \NEkman\ModelLogger\Contract\Logable;

class Estilo extends \BaseModel implements Logable{
	
	protected $table = 'estilo';

	protected $guarded = array('id');

	protected $fillable = [];

/**
 * [getLogName description]
 * @return Retorna el Usuario que esta Autenticado
 */
	public function getLogName() 
	{
		return $this->id;
	}
}