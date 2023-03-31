<?php
require_once "../config/Conexion.php";

/**
 * Esta clase trabaja con las referencias (WEB, TV..)
 */

class Reference{
  public $id="";
  private $conec;

  public $refAddArray = array();

  function __construct(){
    $this->conec = new Conexion();
    $this->conec = $this->conec->conectar();
  }

/**
 * Esta función permite agregar nuevas referencias de forma múltiple.
 * @param {Number} IdVot el ID del voto
 * @param {Number} CodRef valor de referencia (1-4)
 */
  public function AddReferences(){
    $sqlQuery="INSERT INTO referencias (IdVot, CodRef) VALUES (?,?)";    
    $pre = mysqli_prepare($this->conec, $sqlQuery);
    foreach($this->refAddArray as $key ){       
       $pre->bind_param("ii", $key['IdVot'], $key['CodRef']);
       $pre->execute();
      }
      $pre->close();
    return true;
  }

  /**
   * Esta función obtiene el total de referencias por ítem, ej. TV: 2
   */
  public function TotalByRefer(){    
    $arrDataResp = array();
    $rs = $this->conec->query("SELECT CodRef, count(*) as totales FROM referencias group by CodRef");
    while($obj = $rs->fetch_object()){
    array_push($arrDataResp, $obj);
    }    
    $rs->close();
    return $arrDataResp;
  }

   /**
   * Esta función obtiene la suma del  total por items por referencia
   */
  public function SumTotalReferByItem(){    
    $arrDataResp = array();
    $rs = $this->conec->query("select sum(totales) as total from (SELECT CodRef, count(*) as totales FROM referencias group by CodRef) as a");
    while($obj = $rs->fetch_object()){
    array_push($arrDataResp, $obj);
    }    
    $rs->close();
    return $arrDataResp;
  }

/**
   * Esta función permite eliminar las referencias
   * @param {Number} recibe un ID
   */
  public function DeletRefer(){
    $sqlQuery="DELETE FROM referencias WHERE IdVot=?";
    $pre = mysqli_prepare($this->conec, $sqlQuery);
    $pre->bind_param("i", $this->id);
    if($pre->execute()){
      $pre->close();
      return true;
    }else{
      return false;
    }   
  }


  /**
   * Esta función permite obtener mediante el parametro de Id de referencia, los títulos a las mismas,
   * mediante un switch que por defecto al estar en 0  recibe un Array, para retornar un array con los títulos, en situación de 
   * ser otro valor como un 1, recibe un número con el cual solo se retornará el titulo relacionado a esa key.
   * 
   *@return {String} retorna un título si la opción de ingreso es "int" en "search y el "sw" tiene valor 1
   *@return {Array} retorna un array con los títulos si la opción de ingreso es "array" en "search" y el "sw" tiene valor 0.
   */
 function getRefMediaReference(array|int $search, $sw = 0){
    $List = array(1 => 'WEB', 2 => 'TV', 3 => 'Redes Sociales', 4 => 'Amigo');
    $ListRef = array();
    foreach($List as $key=>$value){
      if($sw==0){ // search Array
        if(in_array($key,$search)){
          $ListRef[]= $value; // carga los títulos en un array
        }
      }else{  // search Int
          if($search==$key){
              return $value; // retorna solo el título relacionado e la key.
          }
      }     
    }
    return $ListRef;
  }

}
  ?>