
$(function(){ 

  /**
   * botón registrar voto
   */
   $("#btnreg").click(function(){ 
    if(countChecks($(".controlcheck"))>=2){
      newvotedata();
      $(".error_refdatainfo").html('');
    }else{
      $(".error_refdatainfo").html("Completar mínimo 2 opciones de referencias");
    } 
   });

/**
 * Espacio de código para gestionar regiones y comunas
 */
  $('body').on('change','.controlselect ',function(e){
    e.preventDefault();
    var refdatamsg = '.msgContainer .count_'+$(this).attr('id');
    if($(this).val()==""){      
      $(refdatamsg).html( $(this).attr('data-cap') + '/' + $(this).attr('data-cap')); 
      $("#refcom").html(' <option value="">Seleccione primero región</option>  ');
    }else{
      $(refdatamsg).html( '0/' + $(this).attr('data-cap'));
      getListComs($(this).val());
    }
  });

  // Contador de caracteres por input del formulario 
   $(".controls").keyup(function(){
    countData($(this));
  });

    // Contador de caracter por check del formulario 
   $(".controlcheck").click(function(){
    countChecks($(".controlcheck"));
   })

   getListReg();
   getListCand();


   /**
    * Espacio de código para validar el campo Alias, que ingrese almenos un número y una letra
    */
   $(".refaliasdata").bind('keyup', function(event) {
    var cadena = $(this).val();
    var swletra =0;
    var swnum = 0;
    var Numero = false;
    var Letra = false;
    if(cadena.length < 5){
       $(".error_refalias_length").html("El Alias debe contener como mínimo 5 caracteres");
        
    }else{
      $(".error_refalias_length").html("");
    }
    var caract;  $swn=0; $swc =0;
	for(i=0; i<cadena.length; i++) {
    $(".error_refalias").html("");
     caract = cadena.charAt(i);
    if (!isNaN(caract)){       
        if(swletra == 0){        
          Numero = true;  //  console.log('Existe almenos un número en el string');        
          swletra = 1;
        }
    }else{
         if( swnum==0){
            Letra = true;  //  console.log('Existe almenos una letra en el string');
            swnum=1;
        }   
    }    
   }  
      if(Numero==false){
        $(".error_refalias").html("El Alias debe contener al menos un número");
            //console.log("Debe introducir al menos un número");
        }
        if(Letra==false){
          $(".error_refalias").html("El Alias debe contener  al menos una letra"); 
         // console.log("Debe introducir al menos una letra");
        }  
   });

/**
    * Espacio de código para validar el campo Alias, que ingrese solo números y letras
    */
   // Validar solo n+umeros y letras 
   $(".refaliasdata").bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
   }
  });  


/**
    * Espacio de código para validar el campo Email
    */
  $('#refmail').keyup(function(){
    if($("#refmail").val().indexOf('@', 0) == -1 || $("#refmail").val().indexOf('.', 0) == -1) {
      $(".error_refmail").removeClass('textgreen').addClass('textred');
       $(".error_refmail").html('El correo electrónico introducido no es correcto.');
        return false;
    }
    $(".error_refmail").html('El email introducido es correcto.');
    $(".error_refmail").removeClass('textred').addClass('textgreen');
});
});

/**
    * función para contar el número de campos Checkbox seleccionados
    */
function countChecks(checkref){
  var $checkboxes = checkref; //$('.CheckContainer input[type="checkbox"]');        
  //$checkboxes.change(function(){
      var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
      if(countCheckedCheckboxes < 2){
        $('.count_refdatainfo').removeClass('textgreen').addClass('textred');
      }else{
        $('.count_refdatainfo').removeClass('textred').addClass('textgreen');
        $(".error_refdatainfo").html('');
      }
      $('.count_refdatainfo').text(countCheckedCheckboxes+"/4");
  //})
  return countCheckedCheckboxes;
}

/**
    * función para contar el número de caracteres por input
    */
function countData($dataref){
  let total = $dataref.attr('data-cap');
  let curretdata = $dataref.val();  
if(parseInt($dataref.val().length) <= parseInt($dataref.attr('data-cap')) )
  {      
    $dataref.val(curretdata.substring(0, total));
    totaldisp = parseInt(total)  - parseInt($dataref.val().length);
    var refdatamsg = '.msgContainer .count_'+$dataref.attr('id');
    $(refdatamsg).html( totaldisp + '/' + total ); 
  }else{
    $dataref.val(curretdata.substring(0, total));
  }
}

/**
    * función para asignar los errores cuando están disponibles
    */
function LoadError(obj){
  $(".error_refmail").removeClass('textgreen').addClass('textred');
  $(".error_refname").html(obj.ErrorName);
  $(".error_refalias").html(obj.ErrorAlias);
  $(".error_refrut").html(obj.ErrorDNI);   
  $(".error_refmail").html(obj.ErrorMail);
  $(".error_refreg").html(obj.ErrorReg);
  $(".error_refcom").html(obj.ErrorCom);
  $(".error_refcom").html(obj.ErrorCand);
  return false;
}

/**
    * función para agregar un nuevo voto
    */
function newvotedata(){
    var dir = ""; 
    var refdata = $("#frmNewVote").serialize();
           refdata+= "&codparam=nuevo";       
           dir = DataBaseUrl + 'procesa/proVote.php';
     $.post(dir, refdata,
      function(respdata) {
       //alert(respdata);
        var obj = jQuery.parseJSON(respdata);        
        if(obj.ErrorStatus){      
            swal({
              title: "Advertencia!",
              text: obj.MsgData,
              icon: "error",
            });  
            LoadError(obj);            
        }else{
            if(obj.Status) {
              swal({
                title: "Excelente!",
                text: obj.MsgData + "  y  " + obj.Datarefer,
                icon: "success",
              });
              CleanForm($("#frmNewVote"));      
          }else{
            LoadError(obj);
            alert("Rut existente: " + obj.ErrorDNI);
              swal({
                title: "Lo sentimos!",
                text: obj.MsgData,
                icon: "error",
              });              
          }          
            
        }
     });   
}

/**
    * función para obtener los datos de un voto por id
    */
function getdatabycod(Refdata){
    var dir = ""; 
    var refdata= "codparam=actualizar&codref="+Refdata;
    dir = DataBaseUrl + 'procesa/proVote.php';
     $.post(dir, refdata,
     function(respdata) {
        var obj = jQuery.parseJSON(respdata);
        if(obj.status){
            var dataVot = obj.data;           
              $("#codref").val(dataVot['IdVot']); 
              $("#refrut").val(dataVot['VotDNI']);
              $("#refname").val(dataVot['VotNombre']); 
              $("#refalias").val(dataVot['VotAlias']); 
              $("#refmail").val(dataVot['VotMail']);          
              getListReg(dataVot['IdRegion']);
              getListComs(dataVot['IdRegion'], dataVot['IdCommunity']);
              getListCand(dataVot['IdCand']);             
              var checkdata = dataVot['referencia'].split(',');      
              $('.controlcheck').each(function () {
              if(RevValueArray(checkdata,  $(this).val())){
                $(this).prop( "checked", true );
              }
          });
            
        }
    });   
}

/**
    * función para detectar checkbox seleccionados
    */
function RevValueArray(dataArray,  key){
  for($i=0; $i<dataArray.length; $i++){
    if(key == dataArray[$i]){
      return true;
    }
  }
}

/**
    * función para listar regiones
    */
function getListReg(refDataSelect){
  var dir = ""; 
  var refdata= "codparam=listar_regiones";
  dir = DataBaseUrl + 'procesa/proVote.php';
   $.post(dir, refdata,
   function(respdata) {
      var obj = jQuery.parseJSON(respdata);
      if(obj.status){
          var datareg = obj.data;
          $("#refreg").html(datareg);
          (refDataSelect)? $("#refreg").val(refDataSelect) : '';
      }
  });   
}

/**
    * función para listar comunas
    */
function getListComs(refReg, refDataSelect){
  var dir = ""; 
  var refdata= "datacod="+refReg+"&codparam=listar_comunas";
  dir = DataBaseUrl + 'procesa/proVote.php';
   $.post(dir, refdata,
   function(respdata) {
      var obj = jQuery.parseJSON(respdata);
      if(obj.status){
          var datacom = obj.data;
          $("#refcom").html(datacom);
          (refDataSelect)? $("#refcom").val(refDataSelect) :'';
      }
  });   
}

/**
    * función para listar candidatos
    */
function getListCand(refDataSelect){
  var dir = ""; 
  var refdata= "codparam=listar_candidatos";
  dir = DataBaseUrl + 'procesa/proVote.php';
   $.post(dir, refdata,
   function(respdata) {
      var obj = jQuery.parseJSON(respdata);
      if(obj.status){
          var datareg = obj.data;
          $("#refcand").html(datareg);          
          (refDataSelect)? $("#refcand").val(refDataSelect) : '';
      }
  });   
}

/**
    * función para limpiar elementos del formulario
    */
  function CleanForm(DataFrm = false){
    $(DataFrm).find('input').each(function() {
         switch(this.type) {
            case 'password':
            case 'date':
            case 'text':
            case 'hidden':
            case 'email':
                 $(this).val("");
                 break;
            case 'checkbox':
            case 'radio':
                 this.checked = false;
                 break;
         }
    });
    $(DataFrm).find('select').each(function() {
      $(this).val('');
    });
    $(DataFrm).find('textarea').each(function() {
      $(this).val('');
    });

    $(DataFrm).find('.smalldata').each(function() {
      $(this).html('');
    });

    $(".helpdata").html('');
    return false;
  }
