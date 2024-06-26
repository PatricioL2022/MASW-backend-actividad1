<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 25/6/2024
 * Time: 23:27
 */
function edad($edad){
    list($anio,$mes,$dia) = explode("-",$edad);
    $anio_dif = date("Y") - $anio;
    $mes_dif = date("m") - $mes;
    $dia_dif = date("d") - $dia;
    if ($dia_dif < 0 || $mes_dif < 0)
        $anio_dif--;
    return $anio_dif;
}