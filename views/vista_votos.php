<?php
 $dataGeneric = array('ConfigRef'=>'../config/config_public.php');
 $Title = "Detalle votaciones";
 require_once ("header/header.php");
?>

<main class="contenedor">
  <div class="tableview">

   <a href="<?=BASE_URL?>index.php"  class="btnlink"> Nuevo voto </a>
   <a href="<?=BASE_URL?>views/vista_candidatos.php"  class="btnlink"> Estado candidatos </a>
   <div class="referDataView ">  
    <label id="referTitleTab">Total Referencias</label>
    <table class="">
        <tbody id="ViewReferData"></tbody>
    </table>
   </div>  

    <table id="" class="tabstyle" border=0>
    <thead>
        <tr><th colspan=9> Votaciones </th></tr>
    <tr>
    <th>ID</th>
    <th>RUT</th>
    <th>Nombre</th>
    <th>Alias</th>
    <th>Email</th>
    <th>Comuna</th>
    <th>Candidato/Partido</th>
    <th>Referencias</th>
    <th>Options</th>
    </tr>
    </thead>
    <tbody id="ViewListVot">    
    </tbody>
    <table>
</div>
<?php
  $dataJS = array('Data_JS'=>'assets/js/functions.js');
  require_once ("footer/footer.php");
?>
