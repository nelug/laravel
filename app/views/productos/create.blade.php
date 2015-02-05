
{{ Form::_open('Producto creado') }}
    
    {{ Form::_text('codigo') }}

    {{ Form::_text('descripcion') }}

    {{ Form::_text('precio') }}
  
    {{ Form::_submit('Enviar') }}

{{ Form::close() }}