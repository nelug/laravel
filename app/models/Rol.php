<?php

class Rol extends \BaseModel {

    protected $table = 'roles';

	protected $guarded = array('id');

	protected $fillable = [];

	public function rolesassigned()
    {
        return $this->hasMany('role_id');
    }
}
