public function mostrar()
		{
			$table = "leonels";

			$columns = array("", "", "", "", "", "");

			$Searchable = array("", "");

			echo SearchTable::get($table, $columns, $Searchable);
		}
		public function create()
		{
			if (Input::has("_token"))
			{
				$producto = new Producto;
				if ($producto->_create())
				{
					return "success";
				}
				return $producto->errors();
			}
			return View::make("productos.create");
		}
		public function edit()
		{
			if (Input::has("_token"))
			{
				$producto = Producto::find(Input::get("id"));
				if ( $producto->_update() )
				{
					return "success";
				}
				return $producto->errors();
			}
			$producto = Producto::find(Input::get("id"));
			return View::make("productos.edit", compact("producto"));
		}
		public function delete()
		{
			$delete = Producto::destroy(Input::get("id"));
			if ($delete)
			{
				return "success";
			}
			return "error al tratar de eliminar";
		}