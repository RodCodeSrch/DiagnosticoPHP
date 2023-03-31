<?php
 $dataGeneric = array('ConfigRef'=>'config/config_public.php');
 $Title = "Formulario de votaciones";
  require_once ("views/header/header.php");
?>

<main class="contenedor">
  <div class="tableview">
      <div class="lightMenu">
      <a href="<?=BASE_URL?>views/vista_votos.php" class="btnlink"> Ver votación </a>
      <a href="<?=BASE_URL?>views/vista_candidatos.php"  class="btnlink"> Estado candidatos </a>
    </div>

<section class="form-register">  
    <form id="frmNewVote" method="post">
    <h4>Formulario de votación</h4>
        <input type="hidden" class="controls" name="codref" id="codref" placeholder="">

        <!-- nombre y apellido-->
        <input type="text" class="controls" name="refname" id="refname" data-cap="25" title="Nombre y apellidos" placeholder="Nombre y Apellido">
        <div class="msgContainer">
        <div class="MsgLeft"><p class="smalldata error_refname" >  </p></div>
        <div class="MsgRight"><p class=" countdata count_refname" > 25/25 </p></div>
        </div> 

        <!-- Alias  -->      
        <input type="text" class="controls refaliasdata" name="refalias" id="refalias" data-cap="10" title="Alias"  onkeyup="" placeholder="Alias">
        <div class="msgContainer">
        <div class="MsgLeft"><p class="smalldata error_refalias_length" >  </p></div>
        <div>
        <div class="MsgLeft"><p class="smalldata error_refalias" >  </p></div>
        <div class="MsgRight"><p class=" countdata count_refalias" > 10/10 </p></div>
       </div>
        </div> 

       <!-- RUT  -->
        <input type="text" class="controls" name="refrut" id="refrut"  data-cap="12" title="RUT" placeholder="RUT 11111111-1">
        <div class="msgContainer">
        <div class="MsgLeft"><p class="smalldata error_refrut" >  </p></div>
        <div class="MsgRight"><p class=" countdata count_refrut" > 12/12 </p></div>
        </div> 
          
        <!-- Email  -->       
        <input type="email" class="controls" name="refmail" id="refmail" data-cap="30" title="Email" placeholder="email@mail.com">
        <div class="msgContainer">
        <div class="MsgLeft"><p class="smalldata error_refmail" >  </p></div>
        <div class="MsgRight"><p class=" countdata count_refmail" > 30/30 </p></div>
        </div> 
        
        <!-- Región-->
        <select type="select" class="controls controlselect" name="refreg" id="refreg" data-cap="1" title="Región" placelholder="Regiones" >
         <option value="">Seleccionar región </option>     
      </select>        
        <div class="msgContainer">
        <div class="MsgLeft"><p class="smalldata error_refreg" >  </p></div>
        <div class="MsgRight"><p class=" countdata count_refreg" > 1/1 </p></div>
        </div> 
  
         <!-- Comuna -->
         <select type="select" class="controls " name="refcom" id="refcom" data-cap="1" title="Comuna" placelholder="Comunas" >
         <option value="">Seleccionar comuna </option>    
         <option value="">Seleccione primero región</option>         
      </select>        
        <div class="msgContainer">
        <div class="MsgLeft"><p class="smalldata error_refcom" >  </p></div>
        <div class="MsgRight"><p class=" countdata count_refcom" > 1/1 </p></div>
        </div> 

          <!-- Candidato -->
          <select type="select" class="controls " name="refcand" id="refcand" data-cap="1" title="Candidato" placelholder="Comunas" >
         <option value="">Seleccionar candidato </option>    
         <option value="1">candidato 1</option>  
         <option value="2">candidato 2</option>  
      </select>        
        <div class="msgContainer">
        <div class="MsgLeft"><p class="smalldata error_refcom" >  </p></div>
        <div class="MsgRight"><p class=" countdata count_refcom" > 1/1 </p></div>
        </div> 
       

        <div class="CheckContainer">
        <label for=""> Como se entero de nosotros </label><br>
        <label for="" class="textdetails"> (Seleccione mínimo 2 opciones) <br>
        <input type="checkbox" id="refdatainfo[]" name="refdatainfo[]" value="1"  class="controlcheck" > <!-- WEB -->
        <label for=""> WEB </label><br>
        <input type="checkbox" id="refdatainfo[]" name="refdatainfo[]" value="2"  class="controlcheck" > <!-- TV -->
        <label for=""> TV </label><br>
        <input type="checkbox" id="refdatainfo[]" name="refdatainfo[]" value="3"  class="controlcheck" > <!-- RedSoc -->
        <label for=""> Redes sociales </label><br>
        <input type="checkbox" id="refdatainfo[]" name="refdatainfo[]" value="4"  class="controlcheck" > <!-- Amigo -->
        <label for=""> Amigo </label><br>
        </div> 
        <div class="msgContainer">
        <div class="MsgLeft"><p class="smalldata error_refdatainfo" >  </p></div>
        <div class="MsgRight"><p class=" countdata count_refdatainfo " > 0/4 </p></div>
        </div>    

        <button type="button" id="btnreg" class="btnreg" value="Registrar"> Registrar </button>
</form>
    </section>

    </div>
</main>

<?php
 $dataJS = array('Data_JS'=>'assets/js/jquery-functions.js');
  require_once ("views/footer/footer.php");
?>



    
