$(function() {
    $(document).on('click', '#productos',   function(){ productos(this); });
    $(document).on('click', '#usuarios',    function(){ usuarios(this); });
    $(document).on('click', '#logsUser',    function(){ logsUser(this); });
    $(document).on('click', '#logsProducto',function(){ logsProducto(this); });
    $(document).on('click', '#logsEstilo',  function(){ logsEstilo(this); });
    $(document).on("click", "#_create",     function(){ _create(this); });
    $(document).on("click", "#_edit",       function(){ _edit(this); });
    $(document).on("click", "#_delete",     function(){ _delete(this); });
    $(document).on("click", "#_print",      function(){ _print(this); });
    $(document).on("click", "#settings",    function(){ settings(this);});
    $(document).on("click", ".wclose",      function(){ _wclose(); });
    $(document).on("click", "#example tbody tr",  function(){ highlight(this); });
    $(document).on("submit", "form[data-remote]", function(e){ _submit(e, this); });
    $(document).on("change", "#tipo,#ancho,#alto,#letra,#codigo", function(e){ viewCode();});
});

var global_id;

function productos()
{
    $.get( "productos/index", function( data )
    {
        makeTable(data, 'producto/', 'Producto')
    });
}

function usuarios()
{
    $.get( "usuarios/mostrar", function( data )
    {
        makeTable(data, 'usuarios/', 'Usuarios')
    });
}

function logsUser()
{
    $.get( "logs/ViewUser", function( data )
    {
        makeTable(data, 'logs/', 'Logs')
    });
}

function logsProducto()
{
    $.get( "logs/ViewProducto", function( data )
    {
        makeTable(data, 'logs/', 'Logs')
    });
}

function logsEstilo()
{
    $.get( "logs/ViewEstilo", function( data )
    {
        makeTable(data, 'logs/', 'Logs')
    });
}

function settings()
{
    $.get( "productos/settings", function( data )
    {
        $('.modal-body').html(data);
        $('.modal-title').text('Barcode settings');
        $('.bs-modal').modal('show');
        viewCode();
    });  
}


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
                msg.success(form.data('success'), 'Listo!');
                $('.bs-modal').modal('hide');
                oTable.fnDraw();
            }
            else
            {
                msg.warning(data, 'Advertencia!');
            }
        },
        error: function(errors){
            msg.error('Hubo un error, intentelo de nuevo', 'Advertencia!');
        }
    });

    $('input[type=submit]', form).removeAttr('disabled');

    e.preventDefault();
};


function proccess_table($v)
{
    $("#iSearch").val("");
    $("#iSearch").unbind();
    $('.tables').html("");
    $("#table_length").html("");
    $('.dt-container').hide();

    var table = '<table class="dt-table display table-striped table-hover" id="example"><tbody style="background: #ffffff;">';
    table += '<tr>';
    table += '<td style="font-size: 14px; color:#1b7be2;" colspan="7" class="dataTables_empty">Cargando datos del servidor...</td>';
    table += '</tr>';
    table += '</tbody></table>';
    $('.table').html(table);

    $('.bread-current').text($v);

    setTimeout(function(){
        $("#iSearch").focus();
        $('#example_length').prependTo("#table_length");
        $('.dt-container').show();
        
        oTable = $('#example').dataTable();
        $('#iSearch').keyup(function(){
            oTable.fnFilter( $(this).val() );
        })
    }, 300);
}


function highlight(row)
{
    if ( $(row).hasClass("row_selected") ) 
    {
        $("tr").removeClass("row_selected");
        $('.btn_edit').prop("disabled", true);
    }
    else
    {
        $("tr").removeClass("row_selected");
        $(row).addClass('row_selected');
        $('.btn_edit').prop("disabled", false);
    }
};


function _create()
{
    var url = $('.dataTable').attr('url') + 'create';

    $.get( url, function( data )
    {
        $('.modal-body').html(data);
        $('.modal-title').text( 'Crear ' + $('.dataTable').attr('title') );
        $('.bs-modal').modal('show');
    });
}


function _edit()
{
    $id  = $('.dataTable tbody .row_selected').attr('id');
    $url = $('.dataTable').attr('url') + 'edit';
    global_id = $id;
    $.ajax({
        type: "POST",
        url: $url,
        data: {id: $id},
        contentType: 'application/x-www-form-urlencoded',
        success: function (data) {
            $('.modal-body').html(data);
            $('.modal-title').text( 'Editar ' + $('.dataTable').attr('title') );
            $('.bs-modal').modal('show');
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
};


function _delete()
{
    $id  = $('.dataTable tbody .row_selected').attr('id');
    $url = $('.dataTable').attr('url') + 'delete';

    $.confirm({

        confirm: function(){

            $.ajax({
                type: "POST",
                url: $url,
                data: { id: $id },
                contentType: 'application/x-www-form-urlencoded',
                success: function (data, text) {
                    if (data == 'success') {

                        msg.success('Dato eliminado', 'Listo!')
                        oTable.fnDraw();
                        
                    } else {

                        msg.warning('Hubo un erro al tratar de eliminar', 'Advertencia!')
                    }
                },
                error: function (request, status, error) {

                    msg.error(request.responseText, 'Error!')
                }
            });
        }
    });

    $('.modal-title').text( 'Eliminar ' + $('.dataTable').attr('title') );
};


function _print()
{
    $id  = $('.dataTable tbody .row_selected').attr('id');

    $.ajax({
        type: "POST",
        url: "producto/getcode",
        data: { id: $id },
        contentType: 'application/x-www-form-urlencoded',
        success: function (data, text)
        {
            if (data["success"] == true)
            {
                $("#demo").barcode(
                    data["codigo"],
                    data["tipo"],
                    {
                        barWidth:data["ancho"],
                        barHeight:data["alto"],
                        fontSize:data["letra"]
                    });   
                $("#demo").show();
                $.print("#demo");
                $("#demo").hide();
            }
            else
            {
                msg.warning('Hubo un error', 'Advertencia!')
            }
        },
        error: function (request, status, error)
        {
            msg.error(request.responseText, 'Error!')
        }
    });
};

function perfil($id)
{
    global_id = $id;
    $.ajax({
        type: "POST",
        url: 'usuarios/edit',
        data: {id: $id},
        contentType: 'application/x-www-form-urlencoded',
        success: function (data) {
            $('.modal-body').html(data);
            $('.modal-title').text( 'Editar Perfil');
            $('.bs-modal').modal('show');
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
};

function viewCode()
{
    var tipo=$('#tipo').val();
    var ancho=$('#ancho').val();
    var alto=$('#alto').val();
    var letra=$('#letra').val();
    var codigo=$('#codigo').val();

    if( tipo == 'code39' )
    {
        ancho/=2;
    }

    $("#live").barcode(codigo, tipo,
    {
        barWidth:ancho, 
        barHeight:alto, 
        fontSize:letra,
        showHRI:true,
        moduleSize:5
    });   
}

function addRol()
{
    var form = $('#form_addRol');

    $.ajax({
        type: "POST",
        url: form.attr('action'),
        data: form.serialize(),
        contentType: 'application/x-www-form-urlencoded',
        success: function (data) {
            if (data == 'success')
            {
                msg.success(form.data('success'), 'Listo!');
                perfil(global_id);
            }
            else
            {
                msg.warning(data, 'Advertencia!');
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function delRol( $id , $rol )
{
    $.ajax({
        type: "POST",
        url: "usuarios/delrol",
        data: {role_id: $rol, user_id: $id},
        contentType: 'application/x-www-form-urlencoded',
        success: function (data) {
            if (data == 'success')
            {
                msg.success("Rol Removido..!", 'Listo!');
                perfil($id);
            }
            else
            {
                msg.warning(data, 'Advertencia!');
            }
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function makeTable($data, $url, $title)
{
    $( ".DTTT" ).html("");
    $('.table').html($data);
    $('.dt-panel').show();
    $('.dataTable').attr('url', $url);
    $('.dataTable').attr('title', $title);
}

