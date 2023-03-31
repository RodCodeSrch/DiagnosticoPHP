<?php 
  /**
   * Clase para validar el RUT.
   */
class Tools{

/**
   * Esta función pertite verificar si el RUT cumple con la estructura correcta
   * @param {String} recibe el string del RUT
   * @return {Boolean} retorna true o false
   */
    static function ValidaRut ( $rutCompleto ) {
        if ( !preg_match("/^[0-9]+-[0-9kK]{1}/",$rutCompleto)) return false;
            $rut = explode('-', $rutCompleto);
            return strtolower($rut[1]) == Tools::dv($rut[0]);
        }

    /**
   * Esta función permite obtener el digito verificador.
   * @param {Number} recibe la porción numérica del RUT antes del guión.
   * @return {Number|Char} retorna un número o el caracter respectivo ( k ).
   */
    static function dv ( $T ) {
        $M=0;$S=1;
            for(;$T;$T=floor($T/10))
                $S=($S+$T%10*(9-$M++%6))%11;
            return $S?$S-1:'k';
        }

}

?>