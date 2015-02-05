
{{ Form::_open('Producto actualizado') }}
    
    {{ Form::hidden('id', @$producto->id) }}

    {{ Form::_text('codigo', @$producto->codigo) }}

    {{ Form::_text('descripcion', @$producto->descripcion) }}

    {{ Form::_text('precio', @$producto->precio) }}
  
    {{ Form::_submit('Enviar') }}

{{ Form::close() }}