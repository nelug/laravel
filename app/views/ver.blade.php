 <button onclick="agregarCampo();"> Agregar campo de captura </button>
 <form id="formdinamico" name="formdinamico" action="ver">

   <table border="0" width="100%">  
    <tr>
      <td></td>

    </tr>
  </table>

  <div id="contenedorcampos">

  </div>
  <input type="submit" value="enviar">
</form>

<script type="text/javascript">
  var campos = 0;
  function agregarCampo()
  {
    var NvoCampo= document.createElement("div");
    NvoCampo.id= "divcampo_"+(campos);
    NvoCampo.innerHTML=
    "<table>" +
    "   <tr>" +
    "     <td nowrap='nowrap'>" +
    "        <input type='text' size='50' name='" + campos +
    "' id='articu_" + campos + "'>" +
    "     </td>" +
    "     <td nowrap='nowrap'>" +
    "        <a href='JavaScript:quitarCampo(" + campos +");'> Quitar </a>" +
    "     </td>" +
    "   </tr>" +
    "</table>";
    var contenedor= document.getElementById("contenedorcampos");
    contenedor.appendChild(NvoCampo);
    campos = campos + 1;

    return false;
  }

  function quitarCampo(iddiv)
  {
    var eliminar = document.getElementById("divcampo_" + iddiv);
    var contenedor= document.getElementById("contenedorcampos");
    contenedor.removeChild(eliminar);
  }

</script>
 
 