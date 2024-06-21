<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 19/6/2024
 * Time: 22:02
 */
require_once(__DIR__.'../../models/Serie.php');
function listSeries(){
    $model = new Serie();
    $serieList = $model->getAll();
    $serieObjectArray = [];
    foreach ($serieList as $serieItem)
    {
        $serieObject = new Serie($serieItem->getId(),$serieItem->getTitle(),$serieItem->getPlatformid(),$serieItem->getDirectorid());
        array_push($serieObjectArray,$serieObject);
    }
    return $serieObjectArray;
}
