
<script>
$(document).ready(function() {

    proccess_table('Items');

    $('#example').dataTable({

        "order": [[ 0, "desc" ]],
        
        "aoColumnDefs": [
            {"sClass": "hover widthS hide",         "sTitle": "Id",             "aTargets": [0]},
            {"sClass": "hover widthS",              "sTitle": "Usuario",        "aTargets": [1]},
            {"sClass": "hover widthL",              "sTitle": "Nombre",         "aTargets": [2]},
            {"sClass": "hover aling_right widthS",  "sTitle": "Apellido",       "aTargets": [3]},
            {"sClass": "hover widthS",              "sTitle": "Correo",         "aTargets": [4]},
        ],

        "fnDrawCallback": function( oSettings ) {
            $( ".DTTT" ).html("");
            $( ".DTTT" ).append( '<button id="_create" class="btn btngrey"><i class="fa fa-plus-square"></i> Nuevo</button>' );
            $( ".DTTT" ).append( '<button id="_edit" class="btn btngrey btn_edit" disabled><i class="fa fa-pencil"></i> Editar</button>' );
            $( ".DTTT" ).append( '<button id="_delete" class="btn btngrey btn_edit" disabled><i class="fa fa-times"></i> Eliminar</button>' );
        },

        "bJQueryUI": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "usuarios/lista"
    });

});
</script>

