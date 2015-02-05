<script>
$(document).ready(function() {

    proccess_table('Items');

    $('#example').dataTable({

        "order": [[ 4, "desc" ]],
        
        "aoColumnDefs": [
            {"sClass": "hover widthS",              "sTitle": "Usuario",             "aTargets": [0]},
            {"sClass": "hover widthM",              "sTitle": "Campo",               "aTargets": [1]},
            {"sClass": "hover widthM",              "sTitle": "Anterior",            "aTargets": [2]},
            {"sClass": "hover widthM",              "sTitle": "Nuevo",               "aTargets": [3]},
            {"sClass": "hover widthS",              "sTitle": "Fecha/Hora",          "aTargets": [4]},
        ],

        "fnDrawCallback": function( oSettings ) {
            $( ".DTTT" ).html("");
        },
        "bJQueryUI": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "logs/ServerEstilo"
    });

});
</script>