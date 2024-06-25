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
function updateSerie($serieId,$serieTitle,$platformId,$directorId,$arrayActorsId,$arrayLanguageAudioId,$arrayLanguageSubtitleId){
    $editSerie = new Serie($serieId,$serieTitle,intval($platformId),null,intval($directorId),null);
    $serieUpdated = $editSerie->update();

    $serieActor = new SerieActor(null,$serieId);
    $serieActor->delete();
    foreach ($arrayActorsId as $itemActorId)
    {
        $newSerieActor = new SerieActor(null,$serieId,intval($itemActorId));
        $newSerieActor->store();
    }

    $serieAudio = new SerieAudio(null,null,$serieId);
    $serieAudio->delete();
    foreach ($arrayLanguageAudioId as $itemLanguageId)
    {
        $newSerieAudio = new SerieAudio(null,intval($itemLanguageId),$serieId);
        $newSerieAudio->store();
    }

    $serieSubtitle = new SerieSubtitle(null,null,$serieId);
    $serieSubtitle->delete();
    foreach ($arrayLanguageSubtitleId as $itemLanguageId)
    {
        $newSerieSubtitle = new SerieSubtitle(null,intval($itemLanguageId),$serieId);
        $newSerieSubtitle->store();
    }
    return $serieUpdated;
}
function deleteSerie($serieId){
    $serie = new Serie($serieId);
    $serieDeleted = $serie->delete();

    return $serieDeleted;
}
function getActorsBySerie($serieId)
{
    $serieActor = new SerieActor();
    return $serieActor->getActorsBySerie($serieId);
}
function getAudiosBySerie($serieId)
{
    $serieAudio = new SerieAudio();
    return $serieAudio->getAudiosAvailableBySerie($serieId);
}
function getLanguagesBySerie($serieId)
{
    $serieSubtitle = new SerieSubtitle();
    return $serieSubtitle->getSubtitlesAvailableBySerie($serieId);
}
