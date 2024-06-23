<?php
require_once(__DIR__ . '../../models/Director.php');

function listDirector()
{
    $model = new Director();
    $directorList = $model->getAll();
    $DirectorObjectArray = [];  
    $jsonListData = json_encode($directorList);  
    foreach ($directorList as $directorItem) {
        $directorObject = new Director($directorItem->getId(), $directorItem->getName(), $directorItem->getLastName(), $directorItem->getBirthday(), $directorItem->getNationality());
        array_push($DirectorObjectArray, $directorObject);
    }
    return $DirectorObjectArray;
}
function getDirectorById($DirectorId)
{
    $model = new Director();
    $directorObject = $model->getById($DirectorId);
    return $directorObject;
}
function storeDirector($DirectorName, $DirectorLastName, $DirectorBirthday, $DirectorNationality)
{
    $newDirector = new Director(null, $DirectorName, $DirectorLastName, $DirectorBirthday, $DirectorNationality);
    $DirectorCreated = $newDirector->store();
    return $DirectorCreated;
}
function updateDirector($DirectorId, $DirectorName, $DirectorLastName, $DirectorBirthday, $DirectorNationality)
{
    $Director = new Director($DirectorId, $DirectorName, $DirectorLastName, $DirectorBirthday, $DirectorNationality);
    $DirectorUpdated = $Director->update();
    return $DirectorUpdated;
}
function deleteDirector($DirectorId)
{
    $Director = new Director($DirectorId, null);
    $DirectorDeleted = $Director->delete();
    return $DirectorDeleted;
}
