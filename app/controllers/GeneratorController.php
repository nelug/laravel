<?php

class GeneratorController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	public function GenerateCode()
	{
		$id = Input::get('id');

		$producto = Producto::find($id);

		$bc = new Barcode39($producto->codigo);
		$bc->barcode_text_size = 3;
		$bc->barcode_bar_thick = 3;
		$bc->barcode_bar_thin = 1;
		$bc->barcode_height = 80;
		$bc->barcode_text = true;
		$bc->draw();
	}
}
