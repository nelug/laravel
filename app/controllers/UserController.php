<?php

class UserController extends \BaseController {

	public function mostrar()
	{
		return View::make('usuarios.mostrar');
	}
	
	public function lista()
	{
		$table = 'users';

		$columns = array("id", "username", "nombre", "apellido", "email");

		$Searchable = array("username", "nombre", "apellido", "email");

		echo SearchTable::get($table, $columns, $Searchable);
	}

	public function create()
	{
		if (Input::has('_token'))
		{
			$user = new User;

			if ($user->_create())
			{
				return 'success';
			}

			return $user->errors();
		}

		return View::make('usuarios.create');
	}

	public function edit()
	{
		if (Input::has('_token'))
		{
			$user = User::find(Input::get('id'));
			
			if ( $user->_update() )
			{
				return 'success';
			}

			return $user->errors();
		}

		//roles no asignados
		$noassigned=DB::table('roles') 
		->WhereNotExists(function($query)
			{ $query->select()->from('assigned_roles')
			->whereRaw('roles.id = assigned_roles.role_id')
			->whereRaw('assigned_roles.user_id = '.Input::get('id'));})->get();

		//roles asignados
		$assigned=DB::table('roles') ->whereExists(function($query)
			{ $query->select()->from('assigned_roles')
			->whereRaw('roles.id = assigned_roles.role_id')
			->whereRaw('assigned_roles.user_id = '.Input::get('id'));})->get();

		$user = User::find(Input::get('id'));

		return View::make('usuarios.edit',  array('user' => $user ,'assigned' => $assigned , 'noassigned' => $noassigned));
	}

	public function delete()
	{
		$delete = User::destroy(Input::get('id'));

		if ($delete)
		{
			return 'success';
		}

		return 'error al tratar de eliminar';
	}

	public function addrol()
	{
		if (Input::get('role_id')==null) 
			return 'Sin rol a asignar..!';
		
		$add = new Roleassigned();
		$rol = Rol::where('name', '=', Input::get('role_id'))->firstOrFail();

		$add->user_id = Input::get('user_id');
		$add->role_id = $rol->id;
		$add->save();

		return 'success';
	}

	public function delrol()
	{
		DB::table('assigned_roles')
            ->where('user_id', '=',Input::get('user_id'))
            ->where('role_id', '=', Input::get('role_id'))
            ->delete();
            
		return 'success';
	}

}