<?php

class ProductoController extends \BaseController {

	public function index()
	{
		return View::make('productos.index');
	}

	public function mostrar()
	{
		$table = 'productos';

		$columns = array("id", "codigo", "descripcion", "precio", "created_at", "updated_at");

		$Searchable = array("codigo", "descripcion");

		echo SearchTable::get($table, $columns, $Searchable);
	}


	public function create()
	{
    	if (Input::has('_token'))
        {
            $producto = new Producto;

            if ($producto->_create())
            {
                return 'success';
            }

            return $producto->errors();
    	}

        return View::make('productos.create');
    }


    public function edit()
    {
    	if (Input::has('_token'))
        {
	    	$producto = Producto::find(Input::get('id'));

			if ( $producto->_update() )
			{
		        return 'success';
			}
            
			return $producto->errors();
    	}

        $producto = Producto::find(Input::get('id'));

        return View::make('productos.edit', compact('producto'));
    }

    public function delete()
    {
    	$delete = Producto::destroy(Input::get('id'));

    	if ($delete)
    	{
    		return 'success';
    	}

    	return 'error al tratar de eliminar';
    }

    public function settings()
    {
        if (Input::has('_token'))
        {
            $estilo = Estilo::find(1);

            if ( $estilo->_update() )
            {
                return 'success';
            }
            
            return $estilo->errors();
        }
        $estilo = Estilo::find(1);

        return View::make('productos.settings',compact('estilo'));
    }

    public function getcode()
    {
        $producto = Producto::find(Input::get('id'));
        $estilo = Estilo::find(1);
        $ancho = 2;

        if ($estilo->tipo == 'code39') 
        {
           $ancho = $estilo->ancho/=2;
        }
        
        $data  = array(
            'success' => true,
            'codigo'  => $producto->codigo,
            'tipo'    => $estilo->tipo,
            'ancho'   => $ancho,
            'alto'    => $estilo->alto,
            'letra'   => $estilo->letra
            );

        return Response::json($data);
    }
}
