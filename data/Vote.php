<?php
require_once "../config/Conexion.php";

class Vote{
  public $id="";
  public $dniref="";
  public $nombre="";
  public $alias="";
  public $correo="";
  public $IdCom="";
  public $IdCand="";
  private $conec;

  function __construct(){
    $this->conec = new Conexion();
    $this->conec = $this->conec->conectar();
  }

/**
 * Esta función obtiene el listado de los votos realizados agrupando las 
 * referencias indicadas como (TV, WEB, etc), por el ID del voto.
 * Las referencias están registradas por votante con parámetros del 1 al 4
 *  
 */
  public function getVotes(){    
    $arrDataResp = array();
   $rs = $this->conec->query("
   SELECT 
      votaciones.IdVot, 
      votaciones.VotDNI, 
      votaciones.VotNombre, 
      votaciones.VotAlias, 
      votaciones.VotMail, 
      communities.Community, 
      candidatos.Candidato, 
      candidatos.Partido,
      if(votaciones.IdVot = referencias.IdVot, (SELECT GROUP_CONCAT(referencias.CodRef) FROM referencias WHERE votaciones.IdVot = referencias.IdVot),'') AS Referdata
      FROM votaciones, communities, candidatos, referencias
          WHERE 
          votaciones.IdCommunity = communities.IdCommunity
          AND 
          votaciones.IdCand = candidatos.IdCand 
          AND 
          votaciones.IdVot = referencias.IdVot          
          GROUP BY votaciones.IdVot");
    while($obj = $rs->fetch_object()){
      array_push($arrDataResp, $obj);
    }    
    $rs->close();
    return $arrDataResp;    
  }


  /**
   * Esta función permite registrar los votos, con las variables pre-cargadas desde "proVote.php"
   * 
   *@param {String} VotDNI  el RUT del votante
   *@param {String}  VotNombre  el nombre del votante
   *@param {String}  VotAlias el alias del votante
   *@param {String}  VotMail el email del votante
   *@param {Number}  IdCommunity la comuna del votante
   *@param {Number}  IdCand el candidato elegido del votante
   *@return {Array} retorna un array, es situación correcta de ingreso, retorna el ID del registro, en 
   * situación de error, como duplicidad del RUT, retorna un array con los datos del  error, el código y el mensaje. 
   */
  public function AddVotes(){
    $MsgResponse = array();
    $NewId = "";  
    $sqlQuery="INSERT INTO votaciones ( VotDNI, VotNombre, VotAlias, VotMail, IdCommunity, IdCand) VALUES (?,?,?,?,?,?)";
    $pre = mysqli_prepare($this->conec, $sqlQuery);
    $pre->bind_param("ssssii", $this->dniref, $this->nombre,$this->alias,$this->correo,$this->IdCom,$this->IdCand);
       
    try{
       $pre->execute();
       $MsgResponse['NewID'] = $pre->insert_id;    
    }catch(mysqli_sql_exception $error){
       $MsgResponse['ErrorID'] = $error->getCode(); // 1062
       $MsgResponse['ErrorMsg'] = $error->getMessage(); // Duplicate entry '88888888-8' for key 'RUT'
    }
    $pre->close();    
    return $MsgResponse;     
  } 


/**
   * Esta función obtiene los datos de un votante junto a la referencia existente mediante el ID del voto, esto 
   * permite retornar la data para (este caso) la actualización.
   *@param {Number}  Id del voto   
   *@return {Object} retorna un objeto, con la data del votante.
   */
   // Obtener datos por ID
  public function getDataVoteById(){    
    $sqlQuery="SELECT * FROM votaciones WHERE IdVot=?";
    $sqlQuery = "
    SELECT 
        votaciones.IdVot, 
        votaciones.VotDNI, 
        votaciones.VotNombre, 
        votaciones.VotAlias, 
        votaciones.VotMail,
        regions.IdRegion,
        regions.Region,
        communities.IdCommunity, 
        communities.Community, 
        candidatos.IdCand, 
        GROUP_CONCAT(referencias.CodRef) as referencia
        FROM 
        votaciones, communities, candidatos, referencias, regions, provinces
        WHERE 
          votaciones.IdCommunity = communities.IdCommunity          
        AND 
          communities.IdProvince = provinces.IdProvince
        AND 
          provinces.IdRegion = regions.IdRegion
        AND 
          votaciones.IdCand = candidatos.IdCand
        AND 
			   votaciones.IdVot = referencias.IdVot
			   AND 
			   votaciones.IdVot = ?;
    ";
    $pre = mysqli_prepare($this->conec, $sqlQuery);
    $pre->bind_param("i", $this->id);
    $pre->execute();
    $DataResp = $pre->get_result();
    $pre->close();
    return $DataResp->fetch_object(); 
  }
  

  /**
   * Esta función permite registrar los votos, con las variables pre-cargadas desde "proVote.php"
   *@param {Integer} Id ID del Voto
   *@param {String} VotDNI  el RUT del votante
   *@param {String}  VotNombre  el nombre del votante
   *@param {String}  VotAlias el alias del votante
   *@param {String}  VotMail el email del votante
   *@param {Number}  IdCommunity la comuna del votante
   *@param {Number}  IdCand el candidato elegido del votante
   *@return {Boolean} retorna true or false 
   */
  // Actualiza data
  public function UpVotes(){
    $sqlQuery="UPDATE votaciones SET VotDNI=?, VotNombre=?, VotAlias=?, VotMail=?, IdCommunity=?, IdCand=? WHERE IdVot=?";
    $pre = mysqli_prepare($this->conec, $sqlQuery);
    $pre->bind_param("ssssiii",  $this->dniref, $this->nombre,$this->alias,$this->correo,$this->IdCom,$this->IdCand, $this->id);
    //$pre->execute();
    //$pre->close();  
    if($pre->execute()){
      $pre->close();
      return true;
    }else{
      return false;
    }
  }


/**
   * Esta función elimina los datos de un voto.
   *@param {Number}  Id del voto   
   *@return {Boolean} retorna true o false.
   */
  public function DeletVotes(){
    $sqlQuery="DELETE FROM votaciones WHERE IdVot=?";
    $pre = mysqli_prepare($this->conec, $sqlQuery);
    $pre->bind_param("i", $this->id);
    if($pre->execute()){
      $pre->close();
      return true;
    }else{
      return false;
    }   
  }


}

?>
