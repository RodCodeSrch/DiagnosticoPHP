<?php
require_once "../config/Conexion.php";
/**
 * Esta clase trabaja con candidatos.
 */

class Candidate{
  public $idcom;
  private $conec;

  function __construct(){
    $this->conec = new Conexion();
    $this->conec = $this->conec->conectar();
  }
  
   /**
   * Esta función obtiene el listado de candidatos
   */
  public function getCandidate(){    
        $arrDataResp = array();
        $rs = $this->conec->query(" SELECT IdCand, Candidato, Partido FROM candidatos");
        while($obj = $rs->fetch_object()){
        array_push($arrDataResp, $obj);
        }    
        $rs->close();
        return $arrDataResp;
  }

  /**
   * Esta función obtiene el total de votos por candidato
   */
  public function LoadTotalVotes(){
    $arrDataResp = array();
        $rs = $this->conec->query("SELECT 
    candidatos.Candidato, candidatos.Partido
    , COUNT(*) AS Votos FROM votaciones, candidatos 
    WHERE 
    votaciones.IdCand = candidatos.IdCand
    GROUP BY candidatos.Candidato ORDER BY Votos DESC");
        while($obj = $rs->fetch_object()){
        array_push($arrDataResp, $obj);
        }    
        $rs->close();
        return $arrDataResp;
  }  

  /**
   * Esta función obtiene la suma del  total por votos por candidato
   */
  public function SumTotalCandByItem(){    
    $arrDataResp = array();
    $rs = $this->conec->query("select sum(totales) as total FROM
     (SELECT candidatos.IdCand, count(*) as totales FROM candidatos,votaciones WHERE  candidatos.IdCand =  votaciones.IdCand 
    group by candidatos.IdCand) AS a ");
    while($obj = $rs->fetch_object()){
    array_push($arrDataResp, $obj);
    }    
    $rs->close();
    return $arrDataResp;
  }
}

?>