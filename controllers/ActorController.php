<?php

require_once(__DIR__.'../../models/Actor.php');
    function listActorforms(){
        $model = new Actor();
        $actformList = $model->getAll();
        $actformObjectArray = [];
        foreach ($actformList as $actformItem)
        {
            $actformObject = new Actor($actformItem->getId(),$actformItem->getName(),$actformItem->getLastname(),$actformItem->getBirthday());
            array_push($actformObjectArray,$actformObject);
        }
        return $actformObjectArray;
    }
    function getActorformById($actformId){
        $model = new Actor();
        $actformObject = $model->getById($actformId);
        return $actformObject;
    }

    function insertActor($actorName, $actorLastname, $actorBirthday){
        $newActor = new Actor(null,$actorName,$actorLastname,$actorBirthday);
        $actorCreated = $newActor->insert();
        return $actorCreated;
    }

    function updateActor($actorId,$actorName, $actorLastname, $actorBirthda){
        $actor = new Actor($actorId,$actorName, $actorLastname, $actorBirthda);
        $actorUpdated = $actor->update();
        return $actorUpdated;
    }
    function deleteAct($actId){
        $actor = new Actor($actId,null, null, null);
        $actorDelete = $actor->delete();
        return $actorDelete;
    }
