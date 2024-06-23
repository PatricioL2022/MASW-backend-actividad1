<?php

require_once(__DIR__.'../../models/Language.php');
    function listLanguage(){
        $model = new Language();
        $languageList = $model->getAll();
        $languageObjectArray = [];
        foreach ($languageList as $languageItem)
        {
            $languageObject = new Language($languageItem->getId(),$languageItem->getName(),$languageItem->getIsocode());
            array_push($languageObjectArray,$languageObject);
        }
        return $languageObjectArray;
    }
    function getLanguageById($lenguagemId){
        $model = new Language();
        $lenguageObject = $model->getById($lenguagemId);
        return $lenguageObject;
    }

    function insertLanguage($languageName, $languageIsocode){
        $newLanguage = new Language(null,$languageName,$languageIsocode);
        $languageCreated = $newLanguage->insert();
        return $languageCreated;
    }

    function updateLanguage($languageId, $languageName, $languageIsocode){
        $language = new Language($languageId, $languageName, $languageIsocode);
        $LanguageUpdated = $language->update();
        return $LanguageUpdated;
    }
    function deleteLanguage($languageId){
        $Language = new Language($languageId,null, null);
        $languageDelete = $Language->delete();
        return $languageDelete;
    }
