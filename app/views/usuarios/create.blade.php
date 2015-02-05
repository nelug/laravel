{{ Form::_open('Usuario Creado') }}
    
    {{ Form::_text('username') }}

    {{ Form::_text('nombre') }}

    {{ Form::_text('apellido') }}

    {{ Form::_text('email') }}

    {{ Form::_password('password') }}
  
    {{ Form::_submit('Enviar') }}

{{ Form::close() }}