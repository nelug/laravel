<?php
use \NEkman\ModelLogger\Contract\Logable;

class VentaDetalle extends \BaseModel implements Logable{
	
	protected $table = 'vetas_detalle';

	protected $guarded = array('id');

	protected $fillable = [];

	public function venta()
    {
        return $this->belongsTo('Venta','venta_id');
    }

    public function producto()
    {
        return $this->belongsTo('Producto','producto_id');
    }


	public function getLogName() 
	{
		return $this->id;
	}
}