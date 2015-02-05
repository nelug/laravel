<?php
use \NEkman\ModelLogger\Contract\Logable;

class Venta extends \BaseModel implements Logable{
	
	protected $table = 'ventas';

	protected $guarded = array('id');

	protected $fillable = [];

	public function user()
    {
        return $this->belongsTo('User','user_id');
    }

    public function ventadetalle()
    {
        return $this->hasMany('VentaDetalle');
    }

	public function getLogName() 
	{
		return $this->id;
	}
}