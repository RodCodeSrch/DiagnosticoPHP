<?php
include_once "../data/Vote.php"; // Datos de votante
include_once "../data/Reference.php"; // Información referencial (WEB, TV ..)
include_once "../data/Region.php"; // Regiones
include_once "../data/Commune.php"; // Comunas
include_once "../data/Candidate.php"; // Candidatos
include_once "../tools/tools.php"; // Validación de RUT


  /**
   * Este espacio de código permite mediante la recepción de un parametro, realizar una determinada tarea, como listar datos.
   *@param {String} codparam parametro de opciónes, como "Listar".
   */
 $option = (isset($_REQUEST['codparam'])) ? $_REQUEST['codparam']: '' ;
 $votoref = new Vote();
 $datarefer = new Reference();
 $dataCand = new Candidate(); 

 switch ($option) {
 /**
   * Este espacio de código permite mediante la recepción de un parametro, realizar una determinada tarea, como listar datos.
   * @return {JSON} retorna un Json_encode con los datos existentes en la tabla votaciones a la vista "index.php"
   */
  case 'listar':    
      $arrResponseData = array('status'=> false, 'data' => "");
      $arrDataResp = $votoref->getVotes();
      if(!empty($arrDataResp)){
        for($i=0; $i < count($arrDataResp); $i++){          
          $List = implode(',', $datarefer->getRefMediaReference( explode(',',$arrDataResp[$i]->Referdata))); // Obtiene los titulos de las referencias  "WEB, TV.."       
          $dataId = $arrDataResp[$i]->IdVot;
          $btns = '<a href="'.BASE_URL.'index.php?codopt='.$dataId.'" class="button-edit "  role="button" title="Editar registro" > A </a>
                <button class="button-trsh" title="Borrar registro" onclick="AlertDeletVot('.$dataId.')"> X </button>';
          $arrDataResp[$i]->options = $btns;
          $arrDataResp[$i]->referTitles = $List;
        }
        $arrResponseData['status'] = true;
        $arrResponseData['data'] = $arrDataResp;
      }
      echo json_encode($arrResponseData);
    break;

     /**
   * Este espacio de código permite mediante la recepción de un parametro, realizar una determinada tarea, como Nuevo registro de datos.
   * 
   * Gestión de errores:  Error[parámetro]
   * Los errores en la recepción de datos desde el formulario son cargados en en array de datos, indicando la clave de "error" y el "valor" con un mensaje referido al error.
   * @return {JSON} retorna un Json_encode con los datos existentes en la tabla votaciones a la vista "index.php"
   */
    case 'nuevo':

      $swRef = 0;
      $ErrorData = array('ErrorStatus' => '', 'MsgData' => '', 
      'ErrorName' => '', 
      'ErrorAlias' => '',
      'ErrorDNI'=>'',     
      'ErrorMail'=>'', 
      'ErrorReg'=>'',
      'ErrorCom'=>'',
      'ErrorCand'=>'',
      'ErrorCheck' => '');

        // Validar Nombre
        if($_REQUEST['refname']!=""){
          $votoref->nombre = filter_var($_REQUEST['refname'], FILTER_SANITIZE_SPECIAL_CHARS); 
        }else{
          $ErrorData['ErrorName'] = 'El nombre es requerido';
        }
        // Validar Alias
        if($_REQUEST['refalias']!=""){
          $votoref->alias = filter_var($_REQUEST['refalias'], FILTER_SANITIZE_SPECIAL_CHARS); 
        }else{
          $ErrorData['ErrorAlias'] = 'El alias es requerido';
        }
       // Validar RUT
      if($_REQUEST['refrut']!=""){
        $DniData = filter_var($_REQUEST['refrut'], FILTER_SANITIZE_SPECIAL_CHARS);         
        if(Tools::ValidaRut($DniData)){ // valida RUT
          $votoref->dniref = $DniData;
        }else{
          $ErrorData['ErrorDNI'] = 'El Rut no es válido';
        }      
      }else{
        $ErrorData['ErrorDNI'] = 'El Rut es requerido';
      }

       // Validar mail
      if($_REQUEST['refmail']!=""){
        $votoref->correo = filter_var($_REQUEST['refmail'], FILTER_SANITIZE_EMAIL);  
      }else{
        $ErrorData['ErrorMail'] = 'El email es requerido';
      }
          
       $regCod = "";
       // validar región, que sea número
      if($_REQUEST['refreg']!="" && is_numeric($_REQUEST['refreg'])){
        $regCod = filter_var($_REQUEST['refreg'], FILTER_SANITIZE_NUMBER_INT); 
      }else{
        $ErrorData['ErrorReg'] = 'La región es requerida';
      }

      $comCod = "";
      // validar comuna, que sea número
     if($_REQUEST['refcom']!="" && is_numeric($_REQUEST['refcom'])){
      $votoref->IdCom = filter_var($_REQUEST['refcom'], FILTER_SANITIZE_NUMBER_INT); 
     }else{
       $ErrorData['ErrorCom'] = 'La comuna es requerida';
     }
         
     // validar candidato, que sea número
    if($_REQUEST['refcand']!="" && is_numeric($_REQUEST['refcand'])){
     $votoref->IdCand = filter_var($_REQUEST['refcand'], FILTER_SANITIZE_NUMBER_INT); 
    }else{
      $ErrorData['ErrorCand'] = 'El candidato es requerido';
    }    

   // validar checks
    $ListDataCheck = "";
    if($_REQUEST['refdatainfo']){
      $ListDataCheck = filter_var($_REQUEST['refdatainfo'], FILTER_SANITIZE_SPECIAL_CHARS); 
    }else{
       $ErrorData['ErrorCheck'] = 'Cuadros de seleccion son requeridos';
     }  

      // Verifica si existen errores
      $sw=0; 
        foreach ($ErrorData as $key => $value) { 
            if($value!=""){
                $sw=1;                
            }
        }

      // En situación de existir errores en los datos desde el formulario, se retorna el array con errores al mismo.
      if($sw==1){        
        $ErrorData['ErrorStatus'] = true;
        $ErrorData['MsgData'] = "Errores encontrados";
        echo json_encode($ErrorData);
      }else{

        $ReferCod = ""; // ID Para referencias         
        if($_REQUEST['codref']!="" && is_numeric($_REQUEST['codref']) ){ // Si existe ID desde el formulario , se Actualiza la información de la Votación.
          // UPDATE data 
          $ReferCod = $_REQUEST['codref']; 

           // Borrar registros existentes en referencias al Voto para luego ingresar las nuevas referencias indicadas.
            $datarefer->id = $ReferCod;
            $datarefer->DeletRefer();

          $votoref->id = $_REQUEST['codref'];
          $votoref->UpVotes(); // UPDATE
          $dataMsg = array('Status' => true, 'MsgData' => "Datos actualizados correctamente");
          //echo json_encode($dataMsg);        

        }else{ // De no existir ID del registro desde el formulario se genera un Insert de los datos (Votación)

          // CREATE data       
          $Resp = array();
          $Resp = $votoref->AddVotes(); // CREATE 

          // Error de duplicidad de campo RUT, se indica a sw evitar ingreso de data a referencias
          if(isset($Resp['ErrorID']) && $Resp['ErrorID'] == '1062'){
            $dataMsg = array('Status' => false, 'MsgData' => "Lo sentimos el RUT ya ha sido registrado",'ErrorDNI' => 'Lo sentimos el RUT ya ha sido registrado');
            $swRef = 1;
          }else{
            $dataMsg = array('Status' => true, 'MsgData'=>"Votación ingresada", 'Datarefer'=>'');
            if(isset($Resp['NewID']) && is_numeric($Resp['NewID'])){
              $ReferCod = $Resp['NewID'] ;
            }             
          } // if error validate
        }     
        
        if($swRef == 0){ // valida que no existio error para agregar las referencias (tv, WEB, etc)
        $AddArray = array();
          foreach($_REQUEST['refdatainfo'] as $key){  // Lee el array de opciones de referencias 
            if(is_numeric($key)){
                if(in_array($key, $_REQUEST['refdatainfo'] )){
                    $AddArray[] = array('IdVot' =>  $ReferCod , 'CodRef' => $key);  // crea array de datos a ingresar en la tabla referencias                           
                }
            }             
          }        
          // Una vez cargados los datos en "$AddArray[] ", se asignan al array de referencias.
          // Genera el ingreso multiple de datos en referencias.
          $datarefer->refAddArray = $AddArray;
          if( $datarefer->AddReferences()){  // CREATE referencia a (TV, WEB, etc)
            $dataMsg['Datarefer'] = 'referencia ingresada';
            //$dataMsg = array('Status' => true, 'MsgData'=>"Votación ingresada" , 'Datarefer'=>'referencia ingresada');
          }
        }
          echo json_encode($dataMsg);
      } //  Errores en el form 
      
    break;
    case 'actualizar':
      // Obtiene los datos para pasarlos al formulario
      $votoref->id = (isset($_REQUEST['codref'])) ? $_REQUEST['codref']: '' ;
      $votoData = $votoref->getDataVoteById();
      if(empty($votoData)){
        $arrResponseData = array('status'=> false,'MsgData' => "Datos no encontrados", 'data' => "");
      }else{
        $arrResponseData = array('status' => true,'MsgData' => "Datos encontrados", 'data' => $votoData);
      }
      echo json_encode($arrResponseData);
    break;
    case 'borrar':      
       // Borra registro de votante
      if(isset($_REQUEST['datacod']) && is_numeric($_REQUEST['datacod'] )){
        // Borrar registros existentes en referencias al IDVot
        $datarefer->id = $_REQUEST['datacod'];
        if($datarefer->DeletRefer()){
          $votoref->id = $_REQUEST['datacod'];
          $votoData = $votoref->DeletVotes();
          if($votoData){
            $arrResponseData = array('status'=> true,'MsgData' => "Registro eliminado del sistema");
          }else{
            $arrResponseData = array('status' => false,'MsgData' => "Error al eliminar el registro del sistema");
          }
        }   
      }else{
        $arrResponseData = array('status' => false,'MsgData' => "Error, código de registro vacío");
      }              
      echo json_encode($arrResponseData);
    break;
    // Listar regiones en el select del formulario
    case 'listar_regiones':
      $respReg = new Region();    
      $arrResponseData = array('status'=> false, 'data' => "");
      $Response = $respReg->getRegions();
      $dataOpts ='<option value="" >Seleccionar región</option>';
      if(!empty($Response)){
        for($i=0; $i < count($Response); $i++){
          $dataId = $Response[$i]->IdRegion;
          $dataReg = $Response[$i]->Region;
          $dataOpts .='<option value="'.$dataId.'" >'.$dataReg.'</option>';
        }
        $arrResponseData['status'] = true;
        $arrResponseData['data'] = $dataOpts; 
      }
      echo json_encode($arrResponseData);      
      break;
      // Listar comunas en el select del formulario
      case 'listar_comunas':
             $respComm = new Commune();
        if(isset($_REQUEST['datacod']) && is_numeric($_REQUEST['datacod'] )){       
             $arrResponseData = array('status'=> false, 'data' => "");
             $respComm->idparam = $_REQUEST['datacod']; // Id de región  
             $ResponseCom = $respComm->getCommune();
             $dataOpts ='<option value="" >Seleccionar comuna</option>';
          if(!empty($ResponseCom)){
            for($i=0; $i < count($ResponseCom); $i++){
              $dataCId = $ResponseCom[$i]->IdCommunity;
              $dataCom = $ResponseCom[$i]->Community;
              $dataOpts .='<option value="'.$dataCId.'" >'.$dataCom.'</option>';
            }
            $arrResponseData['status'] = true;
            $arrResponseData['data'] = $dataOpts; //$arrDataResp;
          }
      }
      echo json_encode($arrResponseData);  
      break;
      // Listar candidatos en el select del formulario
      case 'listar_candidatos':
        $arrResponseData = array('status'=> false, 'data' => "");
        $ResponseCand = $dataCand->getCandidate();
        $dataOpts ='<option value="" >Seleccionar candidato</option>';
        if(!empty($ResponseCand)){
          for($i=0; $i < count($ResponseCand); $i++){
            $dataId = $ResponseCand[$i]->IdCand;
            $dataCand = $ResponseCand[$i]->Candidato;
            $dataPart = $ResponseCand[$i]->Partido;
            $dataOpts .='<option value="'.$dataId.'" >'.$dataCand.'  - Partido: '.$dataPart.'</option>';
          }
          $arrResponseData['status'] = true;
          $arrResponseData['data'] = $dataOpts; 
        }
        echo json_encode($arrResponseData); 
      break;
      // Listar estado de referencias en la tabla sobre el  formulario
      case 'estado_referencias':
        $totalSum = 0;
        $arrResponseData = array('status'=> false, 'data' => "");
        $TotalRefer = $datarefer ->TotalByRefer();    
        $TotalSum =  $datarefer ->SumTotalReferByItem(); 
        $Params = "<tr><td>Total: ".$TotalSum[0]->total."</td>";       
        if(!empty($TotalRefer)){  
          for($i=0; $i < count($TotalRefer); $i++ ){
            $valor = ($TotalRefer[$i]->totales * 100)/$TotalSum[0]->total ;
            $Params .= "<td><b> ".$datarefer->getRefMediaReference($TotalRefer[$i]->CodRef, 1) ." </b>: ".$TotalRefer[$i]->totales. " (  ".number_format($valor, 1, ',', '.')
             ." %)</td>";
          }
          $Params .= "<tr>";
          $arrResponseData['status'] = true;
          $arrResponseData['data'] =  $Params; 
        }   
        echo json_encode($arrResponseData);        
        break;

       // Listar estado de votaciones 
        case 'estado_votaciones':
          $Params = ""; $TotalCandSum = 0; $respvalue = 0;
          $ListStateVot= $dataCand->LoadTotalVotes();
         $TotalCandSum =  $dataCand ->SumTotalCandByItem(); 
          if(!empty($ListStateVot)){
            for($i=0; $i < count($ListStateVot); $i++ ){
              $respvalue = ($ListStateVot[$i]->Votos * 100)/$TotalCandSum[0]->total ;
              $Params .= "<tr>
              <td class='txtalign'><b>".$ListStateVot[$i]->Candidato ." </b></td>
              <td class='txtalign'>".$ListStateVot[$i]->Partido."</td>
              <td class='txtalign'> ".$ListStateVot[$i]->Votos." (" . number_format($respvalue, 1, ',', '.'). " %)</td></tr>";
            }           
            $arrResponseData['status'] = true;
            $arrResponseData['data'] =  $Params; 
          }
          echo json_encode( $arrResponseData);
        break;
 }
 

/*
 function getRefMedia($search=""){
  $List = array(1 => 'WEB', 2 => 'TV', 3 => 'Redes Sociales', 4 => 'Amigo');
  foreach($List as $key=>$value){
      if($search==$key){
          return $value;
      }
  }
}
*/

 ?>