<table>
	<tr>
		<td style="background: white;" width="370px">
			{{ Form::_open('Usuario Actualizado') }}

			{{ Form::hidden('id', @$user->id) }}

			{{ Form::_text('username',@$user->username,'Usuario') }}

			{{ Form::_text('nombre',@$user->nombre) }}

			{{ Form::_text('apellido',@$user->apellido) }}

			{{ Form::_text('email',@$user->email,'Correo') }}

			{{ Form::_password('password') }}

			<div style="margin-right: 30px;">
				{{ Form::_submit('Enviar') }}
			</div>	

			{{ Form::close() }}
		</td>
		<td style="background: white; vertical-align:top; ">
			{{ Form::open(array('data-remote', 'data-success' => 'Rol Asignado', 'method' =>'post', 'role'=>'form', 'class' => 'form-horizontal all','url' => 'usuarios/addrol','id' => 'form_addRol'));}}
			{{ Form::hidden('user_id', @$user->id) }}
			<div class="row" style="margin-right: 5px;">
				<div class="input-group">
					<span class="input-group-btn">
						<button class="btn btn-default" onclick="addRol()"type="button">+</button>
					</span>
					<select name="role_id" id="" class="form-control" style="width: 150px;">
						@foreach($noassigned as $rol)
							<option name="{{$rol->id}}">{{$rol->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			{{ Form::close() }}

			<div class="row" style="margin-right: 5px;">
			@foreach($assigned as $rol)
				<br>
				<div class="input-group">
					<span class="input-group-btn">
						<button class="btn btn-default" onclick="delRol({{$user->id}},{{$rol->id}})" type="button">-</button>
					</span>
					<input class="form-control" style="width: 150px;" type="text" value="{{$rol->name}}"size="50"  placeholder="" readonly>
				</div>
			@endforeach
			</div>

		</td>
	</tr>
</table>