<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use \NEkman\ModelLogger\Contract\Logable;
use Zizaco\Entrust\HasRole;

class User extends \BaseModel implements UserInterface, RemindableInterface,Logable {

	use UserTrait, RemindableTrait, HasRole;

	protected $table = 'users';

	protected $guarded = array('id');

	protected $fillable = [];

	protected $hidden = array('password', 'remember_token');

	public function venta()
    {
        return $this->hasMany('Venta');
    }

	public function setPasswordAttrihasOnebute($pass)
	{
		$this->attributes['password'] = Hash::make($pass);
	}

	public function getLogName() 
	{
		return $this->username;
	}
}
