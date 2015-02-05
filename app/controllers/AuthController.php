<?php

class AuthController extends BaseController {

/**
 * [Logeo]
 * @return [type] [description]
 */
	public function showLogin()
	{
		if (Auth::check())
		{
			return Redirect::to('/');
		}
		return View::make('login');
	}

	public function postLogin()
    {
        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if(Auth::attempt($userdata, Input::get('remember-me', 0)))
        {
            return 'success';
        }
        
        return 'tus datos son Incorrectos';
    }

     public function logOut()
    {
        Auth::logout();
        return Redirect::to('login');
    }
}
