
<script>
$(document).ready(function() {

    proccess_table('Items');

    $('#example').dataTable({

        "order": [[ 0, "desc" ]],
        
        "aoColumnDefs": [
            {"sClass": "hover widthS hide",         "sTitle": "Id",             "aTargets": [0]},
            {"sClass": "hover widthS",              "sTitle": "Codigo",         "aTargets": [1]},
            {"sClass": "hover widthL",              "sTitle": "Descripcion",    "aTargets": [2]},
            {"sClass": "hover aling_right widthS",  "sTitle": "Precio",         "aTargets": [3]},
            {"sClass": "hover widthS",              "sTitle": "Creado en",      "aTargets": [4]},
            {"sClass": "hover widthS",              "sTitle": "Actualizado en", "aTargets": [5]},
        ],

        "fnDrawCallback": function( oSettings ) {
            $( ".DTTT" ).html("");
            $( ".DTTT" ).append( '<button id="_create" class="btn btngrey"><i class="fa fa-plus-square"></i> Nuevo</button>' );
            $( ".DTTT" ).append( '<button id="_edit" class="btn btngrey btn_edit" disabled><i class="fa fa-pencil"></i> Editar</button>' );
            $( ".DTTT" ).append( '<button id="_delete" class="btn btngrey btn_edit" disabled><i class="fa fa-times"></i> Eliminar</button>' );
            $( ".DTTT" ).append( '<button id="_print" class="btn btngrey btn_edit" disabled><i class="fa fa-barcode"></i> Imprimir</button>' );
        },

        "bJQueryUI": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "productos/mostrar"
    });

});
</script>