<?php

Form::macro('_text', function($column_name, $value = null, $lable_name = null,$tamano=9)
{
    if ($lable_name == null) {
        $lable_name = ucwords($column_name);
    }
    $lable   = Form::label('body', $lable_name, array('class'=>'col-sm-2 control-label'));
    $element = Form::text($column_name, $value, array('class'=>'form-control','id'=>$column_name, 'placeholder' => $lable_name));
    return textWrapper($element, $lable,$tamano);
});

Form::macro('_number', function($column_name, $value = null, $lable_name = null,$tamano=9,$min=0,$max=0)
{
    if ($lable_name == null) {
        $lable_name = ucwords($column_name);
    }
    $lable   = Form::label('body', $lable_name, array('class'=>'col-sm-2 control-label'));
    $element = Form::number($column_name, $value, array('class'=>'form-control','id'=>$column_name,'min'=>$min,'max'=>$max));
    return textWrapper($element, $lable,$tamano);
});

Form::macro('_select', function($column_name, $value, $selected,$lable_name = null,$tamano=9)
{
    if ($lable_name == null) {
        $lable_name = ucwords($column_name);
    }
    $lable   = Form::label('body', $lable_name, array('class'=>'col-sm-2 control-label'));
    $element = Form::select($column_name, $value, $selected ,array('class'=>'form-control','id'=>$column_name));
    return textWrapper($element, $lable,$tamano);
});

Form::macro('_checkbox', function($column_name, $value = null, $selected = false)
{
    $lable_name = ucwords($value);
    $lable   = Form::label('body', $lable_name, array('class'=>'col-sm-2 control-label'));
    $element =  Form::checkbox($column_name, $lable_name , $selected,array('class'=>'form-control'));
    return textWrapper($element, $lable);
});

Form::macro('_password', function($column_name, $value = null)
{
    $lable   = Form::label('body', ucwords($column_name), array('class'=>'col-sm-2 control-label'));
    $element = Form::password($column_name, array('class'=>'form-control', 'placeholder' => 'Password'));
    return textWrapper($element, $lable);
});


function textWrapper($element, $lable,$tamano=9)
{
    $out  = '<div class="form-group">';
    $out .= $lable;
    $out .= '<div class="col-sm-'.$tamano.'">';
    $out .= $element;
    $out .= '</div>';
    $out .= '</div>';
    return $out;
}


/*Form::macro('_select', function($column_name, $value, $id = null)
{
    $lable_name = ucwords($column_name);
    $lable_name = substr($lable_name, 0, -3);

    $lable   = Form::label('body', $lable_name, array('class'=>'col-sm-2 control-label'));
    $element = Form::select($column_name, $value, $id, array('class'=>'form-control'));
    return selectWrapper($element, $lable);
});*/


function selectWrapper($element, $lable)
{
    $out = '<div class="form-group">';
    $out .= $lable;
    $out .= '<div class="col-sm-9">';
    $out .= $element;
    $out .= '</div>';
    $out .= '</div>';
    return $out;
}


Form::macro('_submit', function($value='Enviar')
{
    $enviar = Form::submit($value, ['class'=>'btn btn-primary']);
    $cerrar = Form::button('Cerrar!', ['class'=>'btn btn-default', 'data-dismiss'=>'modal']);
    return submitWrapper($enviar, $cerrar);
});


function submitWrapper($enviar, $cerrar)
{
    $out  = '<div class="modal-footer" style="background: white;">';
    $out .= $cerrar;
    $out .= $enviar;
    $out .= '</div>';
    return $out;
}


Form::macro('_open', function($message)
{
    return Form::open(array('data-remote', 'data-success' => $message, 'method' =>'post', 'role'=>'form', 'class' => 'form-horizontal all'));
});


Form::macro('ddt_open', function($message)
{
    return Form::open(array('ddt-remote', 'data-success' => $message, 'method' =>'post', 'role'=>'form'));
});


Form::macro('md8_open', function()
{
    return Form::open(array('data-remote', 'method' =>'post', 'role'=>'form', 'class' => 'form-horizontal regular col-md-8 all'));
});


Form::macro('button_edit', function($id)
{
    return Form::button('<i class="icon-pencil" style="font-size:18px;"></i>', array('class'=>'btn-link', 'id'=>$id));
});


Form::macro('button_new', function($id)
{
    return Form::button('<i class="icon-plus-sign" style="font-size:18px;"></i>', array('class'=>'btn-link', 'id'=>$id));
});


Form::macro('_label', function($name)
{
    return Form::label('body', $name, array('class'=>'control-label col-lg-3'));
});


Form::macro('_hidden', function($id)
{
    return Form::hidden('id', $id);
});
