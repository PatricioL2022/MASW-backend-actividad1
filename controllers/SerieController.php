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
function getSerieLastId(){
    $model = new Serie();
    $serieObject = $model->getLastId();
    return $serieObject;
}
function storeSerie($serieTitle,$platformId,$directorId,$arrayActorsId,$arrayLanguageAudioId,$arrayLanguageSubtitleId){
    $newSerie = new Serie(null,$serieTitle,intval($platformId),null,intval($directorId),null);
    $serieCreated = $newSerie->store();
    $objectLastSerieId = getSerieLastId();
    $lastSerieId = $objectLastSerieId->getId();
    foreach ($arrayActorsId as $itemActorId)
    {
        $newSerieActor = new SerieActor(null,intval($lastSerieId),intval($itemActorId));
        $newSerieActor->store();
    }
    foreach ($arrayLanguageAudioId as $itemLanguageId)
    {
        $newSerieAudio = new SerieAudio(null,intval($itemLanguageId),intval($lastSerieId));
        $newSerieAudio->store();
    }
    foreach ($arrayLanguageSubtitleId as $itemLanguageId)
    {
        $newSerieSubtitle = new SerieSubtitle(null,intval($itemLanguageId),intval($lastSerieId));
        $newSerieSubtitle->store();
    }


    return $serieCreated;
}
