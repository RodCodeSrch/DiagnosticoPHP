<?php
require_once "../config/Conexion.php";
/**
 * Esta clase trabaja con regiones.
 */
class Region{
  private $conec;

  function __construct(){
    $this->conec = new Conexion();
    $this->conec = $this->conec->conectar();
  }

  /**
   * Esta funcion retorna las regiones
   */
  public function getRegions(){    
        $arrDataResp = array();
        $rs = $this->conec->query("select * from regions");
        while($obj = $rs->fetch_object()){
          array_push($arrDataResp, $obj);
        }    
        $rs->close();
        return $arrDataResp;
  }

}
  ?>