<?php
/**
 * asignamos los modelos para el logger
 *
 * esto para que Guarde la bitacora de cada cambio
 */
User::observe(new \NEkman\ModelLogger\Observer\Logger);
Estilo::observe(new \NEkman\ModelLogger\Observer\Logger);
Producto::observe(new \NEkman\ModelLogger\Observer\Logger);

Route::get('login', 'AuthController@showLogin');

Route::post('login', 'AuthController@postLogin');

/**
 * verificacion de Autenticacion
 */
Route::group(array('before' =>'auth'), function()
{
	Route::get('/', function()
	{
		return View::make('layouts.master');
	});
	Route::get('logout', 'AuthController@logOut');
});

/**
 * Generamos el Codigo de Barras
 */
Route::get('barcode', 'GeneratorController@GenerateCode');

/**
 * Rutas para Manipular el modelo Producto
 */
Route::group(array('prefix' => 'productos'), function()
{
	Route::get('index', 'ProductoController@index');
	Route::get('settings', 'ProductoController@settings');
	Route::post('settings','ProductoController@settings');
	Route::get('mostrar', 'ProductoController@mostrar');
});

/**
 * Rutas para Manipular el modelo Producto
 */
Route::group(array('prefix' => 'producto'), function()
{
	Route::get('create',   'ProductoController@create');
	Route::post('create',  'ProductoController@create');
	Route::post('edit',    'ProductoController@edit');
	Route::post('delete',  'ProductoController@delete');
	Route::post('getcode', 'ProductoController@getcode');
});

/**
 * Rutas para manipular el modelo User
 */
Route::group(array('prefix' => 'usuarios'), function()
{
	Route::get('create',   'UserController@create');
	Route::post('create',  'UserController@create');
	Route::post('edit',    'UserController@edit');
	Route::post('delete',  'UserController@delete');
	Route::get('mostrar',  'UserController@mostrar');
	Route::get('lista',    'UserController@lista');
	Route::post('addrol',  'UserController@addrol');
	Route::post('delrol',  'UserController@delrol');
});

Route::group(array('prefix' => 'logs'), function()
{
	Route::get('ViewUser', 		'LogController@ViewUser');
	Route::get('ViewProducto',  'LogController@ViewProducto');
	Route::get('ViewEstilo',    'LogController@ViewEstilo');

	Route::get('ServerUser', 	'LogController@ServerUser');
	Route::get('ServerProducto','LogController@ServerProducto');
	Route::get('ServerEstilo',  'LogController@ServerEstilo');
});

Route::get('Denegado', function()
{  
	return 'Acceso Denegado';
});


Route::get('test', function()
{  
	$user = App::make('PruebaUser');
	echo "<br><br>";
	echo ($user->notest());
	echo "<br><br>";

	foreach ($user->test() as $key => $value) 
	{
		echo '<br>'.$value->username; 
	}
	
});

class PruebaUser extends BaseController
{
	protected $user;

	function __construct(User $user)
	{
		$this->user = $user;	
	}

	public function notest()
	{
		return $this->user->all();
	}

	public function test()
	{
		return DB::table('users')->get();

	}
}


Route::get('test2', function()
{
	$hola = App::make('PruebaController');
	echo $hola->hola();
});


App::bind('PruebaController', function()
{
	return new HolaMundo2;
});

interface Hola 
{
	public function hola();

}

class PruebaController 
{
	protected $Hola;

	public function __construct(Hola $hola)
	{
		$this->Hola = $hola;
	}

}

class HolaMundo  implements Hola
{
	public function hola()
	{
		return 'Hola ..........!';
	}
}

class HolaMundo2  implements Hola
{
	public function hola()
	{
		return 'mundo ..!';
	}
}

Route::get('test3', function()
{  
	dd(); 
});


class Car 
{
	protected $tire;
	protected $engine;
	public function __construct(Tire $tire, Engine $engine) 
	{
		$this->tire = $tire;
		$this->engine = $engine;	
	}
}

class Tire 
{
	protected $bridgestone;
	public function __construct(Bridgestone $bridgestone) 
	{
		$this->bridgestone = $bridgestone;	
	}
}

class Engine {
	protected $turbo;
	public function __construct(Turbo $turbo) 
	{
		$this->turbo = $turbo;	
	}
}

class Bridgestone 
{
	public $tread;
	public function __construct()
	{
		$this->tread = 'Performance';
	}
}

class Turbo 
{
	public $stage;
	public function __construct()
	{
		$this->stage = 2;
	}
}

Route::get('test4', function()
{
	echo App2::get('message')->greeting(); 
	echo "<br>"; 
});

class App2 {

	private static $instances = [];

	public static function set($name, $instance)
	{
		if (is_string($instance)) {
			$instance = new $instance();
		}

		static::$instances[$name] = $instance;
	}

	public static function get($name)
	{
		$instance = static::$instances[$name];

		if ($instance instanceof Closure) {
			$instance = $instance();
		}

		return $instance;
	}
}

interface MessageInterface 
{
	public function greeting();
}

class EnglishMessage implements MessageInterface 
{
	public function greeting() 
	{
		return 'Hello!'; 
	}
}

class EnglishMessage2 implements MessageInterface 
{
	public function greeting() 
	{
		return 'Hello2!'; 
	}
}

App2::set('message', function() 
{ 
	return new EnglishMessage2(); 
});

Route::get('test10', function()
{   

	return View::make('ver');

});

use Illuminate\Console\Command;
class Meses  extends Command
{
	protected  $mes = array( 
		1 =>'Enero' ,    2 =>'Febrero' ,
		3 =>'Marzo' ,    4 =>'Abril' ,
		5 =>'Mayo'  ,    6 =>'Junio' ,
		7 =>'Julio' ,    8 =>'Agosto' ,
		9 =>'Septiembre',10=>'Octubre' ,
		11=>'Nobiembre' ,12=>'Diciembre' 
		);

	protected  $count=0;
	protected  $arrayMes;
	protected  $arrayFecha;

	public  function view($a , $m )
	{
		$date  = Date::create($a, $m, 1, 0);
		$dt = $date->subMonths($this->count);
		if($this->count!=13)
		{
			$this->arrayMes[$this->count] = $this->mes[$dt->month];
			$this->arrayFecha[$this->count] = Date::create($dt->year, $dt->month, 1)->format('d-m-Y');
			$this->count++;
			$this->view($a, $m);
		}
	}

	public function mes()
	{
		return $this->arrayMes;
	}

	public  function fecha()
	{
		return $this->arrayFecha;
	}

	public function prueba()
	{
		return $this->laravel->path;
	}

}

Route::get('ver', function()
{  



});


Route::group(array('prefix' => 'roles'), function()
{
    Route::get('create', 'RoleController@create');
    Route::post('create', 'RoleController@create');
    Route::post('edit', 'RoleController@edit');
});
