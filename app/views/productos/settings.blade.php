
{{ Form::_open('Producto creado') }}

{{ Form::hidden('id', @$estilo->id) }}

{{Form::_select('tipo', array('code128' => 'code128', 'code39' => 'code39', 'ean13' => 'ean13'), @$estilo->tipo)}}

{{ Form::_number('ancho',@$estilo->ancho,null,9,0,4) }}

{{ Form::_number('alto',@$estilo->alto,null,9,0,100) }}

{{ Form::_number('letra',@$estilo->letra,null,9,0,15) }}

{{ Form::_text('codigo',@$estilo->codigo) }}

<div style="margin-right:50px;">
    {{ Form::_submit('Guardar Cambios') }}
</div>

{{ Form::close() }}

<div align="center" >
    <br>
    <div style="" align="center" id="live"></div>
</div>




