<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 19/6/2024
 * Time: 22:02
 */
require_once(__DIR__.'../../models/Serie.php');
require_once(__DIR__.'../../models/SerieActor.php');
require_once(__DIR__.'../../models/SerieAudio.php');
require_once(__DIR__.'../../models/SerieSubtitle.php');
function listSeries()
{
    $serieActor = new SerieActor();
    $languageAudioAvailable = new SerieAudio();
    $languageSubtitleAvailable = new SerieSubtitle();
    $model = new Serie();
    $serieList = $model->getAll();
    $serieObjectArray = [];
    //$actorObjectArray = [];
    //$audioObjectArray = [];
    foreach ($serieList as $serieItem)
    {
        $actorObjectArray = $serieActor->getActorsBySerie($serieItem->getId());
        $audioObjectArray = $languageAudioAvailable->getAudiosAvailableBySerie($serieItem->getId());
        $subtitleObjectArray = $languageSubtitleAvailable->getSubtitlesAvailableBySerie($serieItem->getId());
        $serieObject = new Serie($serieItem->getId(),$serieItem->getTitle(),null,$serieItem->getPlatformname(),null,$serieItem->getDirectorname(),$actorObjectArray,$audioObjectArray,$subtitleObjectArray);
        array_push($serieObjectArray,$serieObject);
    }
    return $serieObjectArray;
}
function getSerieById($serieId){
    $model = new Serie();
    $serieObject = $model->getById($serieId);
    return $serieObject;
}
