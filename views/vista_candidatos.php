<?php
 $dataGeneric = array('ConfigRef'=>'../config/config_public.php');
 $Title = "Estado votaciones";
 require_once ("header/header.php");
?>
<main class="contenedor">
<div class="lightMenu">
<a href="<?=BASE_URL?>index.php"  class="btnlink"> Nuevo voto </a>
   <a href="<?=BASE_URL?>views/vista_votos.php" class="btnlink"> Ver votación </a>
</div>
  <div class="tableview">
  <div class="referDataView_ ">      
    <table class="tabGenData">
       <thead><tr><th colspan=3>Estado votaciones</th></tr>
       <tr><th >Candidato</th><th >Partido</th><th >Votación</th></tr></thead>
        <tbody id="ViewListStateVot" class=""> 
        </tbody>
    </table>    
   </div>    
</div>
<?php
  $dataJS = array('Data_JS'=>'assets/js/jquery-functions-cand.js');
  require_once ("footer/footer.php");
?>
