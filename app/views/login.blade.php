
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
	<link rel="stylesheet" type="text/css" href="http://daneden.github.io/animate.css/animate.min.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700">
	<style type="text/css">
		.login_body {
			background: #2ecc71 url("http://www.ferreteriacoral.es/wp-content/uploads/2014/08/Productos-ferreteria.png") no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			font-family: "Roboto";
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
		.login_body::before {
			z-index: -1;
			content: '';
			position: fixed;
			top: 0;
			left: 0;
			background: #2ecc71;
			/* IE Fallback */
			background: rgba(46, 204, 113, 0.8);
			width: 100%;
			height: 100%;
		}
		.login_form {
			position: absolute;
			top: 50%;
			left: 50%;
			background: #fff;
			width: 285px;
			margin: -140px 0 0 -182px;
			padding: 40px;
			box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
		}
		.login_form h2 {
			margin: 0 0 20px;
			line-height: 1;
			color: #2ecc71;
			font-size: 18px;
			font-weight: 400;
		}
		.login_form input {
			outline: none;
			display: block;
			width: 100%;
			margin: 0 0 20px;
			padding: 10px 15px;
			border: 1px solid #ccc;
			color: #ccc;
			font-family: "Roboto";
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			font-size: 14px;
			font-wieght: 400;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			-webkit-transition: 0.2s linear;
			-moz-transition: 0.2s linear;
			-ms-transition: 0.2s linear;
			-o-transition: 0.2s linear;
			transition: 0.2s linear;
		}
		.login_form input:focus {
			color: #333;
			border: 1px solid #2ecc71;
		}
		submit{
			cursor: pointer;
			background: #2ecc71;
			width: 100%;
			padding: 10px 15px;
			border: 0;
			color: #fff;
			font-family: "Roboto";
			font-size: 14px;
			font-weight: 400;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			-webkit-transition: 0.2s linear;
			-moz-transition: 0.2s linear;
			-ms-transition: 0.2s linear;
			-o-transition: 0.2s linear;
			transition: 0.2s linear;
		}
		.login_form button:hover {
			background: #27ae60;
		}
	</style>
</head>
<body class="login_body">
	<div class='login_form animated flipInX'>
		<h2>Autenticacion</h2>
		{{ Form::_open('Ingresando') }}
		{{ Form::_text('username') }}
		{{ Form::_password('password') }}
		{{ Form::_checkbox('remember-me', 'recordar password',false) }}
		{{ Form::submit('Ingresar',array('class'=>'animated infinite pulse'))}}
		{{ Form::close() }}
	</div>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
	<script type="text/javascript">

		$(function() {
			$(document).on("submit", "form[data-remote]", function(e){ _submit(e, this); });
		});
		function _submit(e, form)
		{
			var form = $(form);
			$('input[type=submit]', form).attr('disabled', 'disabled');
			$.ajax({
				type: form.attr('method'),
				url: form.attr('action'),
				data: form.serialize(),
				success: function (data)
				{
					if (data == 'success')
					{
						window.location.href = "/";
					}
					else
					{
						toastr.warning(data, 'Advertencia!');
					}
				},
				error: function(errors){
					toastr.error('Hubo un error, intentelo de nuevo', 'Advertencia!');
				}
			});

			$('input[type=submit]', form).removeAttr('disabled');

			e.preventDefault();
		};
	</script>

</body>

</html>