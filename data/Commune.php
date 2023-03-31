<?php
require_once "../config/Conexion.php";

/**
 * Esta clase trabaja con comunas.
 */

class Commune{
  public $idparam;
  private $conec;

  function __construct(){
    $this->conec = new Conexion();
    $this->conec = $this->conec->conectar();
  }
  
  /**
   * Esta función obtiene el listado de comunas por región, mediante la relación región - provincia - comuna
   * @param {Number} idparam recibe el ID de la región  
   */
  public function getCommune(){    
        $arrDataResp = array();
        $rs = $this->conec->query("
        SELECT 
          communities.IdCommunity, 
          communities.IdProvince, 
          communities.Community 
          FROM 
          communities , provinces 
          WHERE 
          provinces.IdProvince = communities.IdProvince 
          and 
          provinces.IdProvince   in ( 
            SELECT provinces.IdProvince 
            FROM provinces, regions 
            where 
            regions.IdRegion = provinces.IdRegion 
            and 
            regions.IdRegion = ".$this->idparam." 
            )");
        while($obj = $rs->fetch_object()){
        array_push($arrDataResp, $obj);
        }    
        $rs->close();
        return $arrDataResp;
  }

}
  ?>