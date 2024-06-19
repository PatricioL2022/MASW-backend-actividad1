<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 17/6/2024
 * Time: 23:39
 */
require_once(__DIR__.'../../models/Platform.php');
    function listPlatforms(){
        $model = new Platform();
        $platformList = $model->getAll();
        $platformObjectArray = [];
        foreach ($platformList as $platformItem)
        {
            $platformObject = new Platform($platformItem->getId(),$platformItem->getName());
            array_push($platformObjectArray,$platformObject);
        }
        return $platformObjectArray;
    }
    function getPlatformById($platformId){
        $model = new Platform();
        $platformObject = $model->getById($platformId);
        return $platformObject;
    }
    function storePlatform($platformName){
        $newPlatform = new Platform(null,$platformName);
        $platformCreated = $newPlatform->store();
        return $platformCreated;
    }
    function updatePlatform($platformId,$platformName){
        $platform = new Platform($platformId,$platformName);
        $platformUpdated = $platform->update();
        return $platformUpdated;
    }
    function deletePlatform($platformId){
        $platform = new Platform($platformId,null);
        $platformDeleted = $platform->delete();
        return $platformDeleted;
    }
