<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 22/6/2024
 * Time: 15:57
 */

class SerieAudio
{
    private $id;
    private $languageId;
    private $serieId;
    private $languageName;
    private $connectionDB;

    /**
     * @param $id
     * @param $languageId
     * @param $serieId
     * @param $languageName
     * @param $connectionDB
     */
    public function __construct($id=null, $languageId=null, $serieId=null, $languageName=null)
    {
        if($id != null)
            $this->id = $id;
        if($languageId != null)
            $this->languageId = $languageId;
        if($serieId != null)
            $this->serieId = $serieId;
        if($languageName != null)
            $this->languageName = $languageName;
        $this->connectionDB = new ConnectionDB();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @param mixed $languageId
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
    }

    /**
     * @return mixed
     */
    public function getSerieId()
    {
        return $this->serieId;
    }

    /**
     * @param mixed $serieId
     */
    public function setSerieId($serieId)
    {
        $this->serieId = $serieId;
    }

    /**
     * @return mixed
     */
    public function getLanguageName()
    {
        return $this->languageName;
    }

    /**
     * @param mixed $languageName
     */
    public function setLanguageName($languageName)
    {
        $this->languageName = $languageName;
    }

    public function getAudiosAvailableBySerie($serieId)
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("select lg.id,lg.name from serieaudio sa inner join language lg on sa.languageid = lg.id inner join serie se on sa.serieid = se.id where se.id = $serieId order by sa.id asc");
        $listData = [];
        foreach ($query as $item)
        {
            $itemObject = new SerieAudio(null,$item['id'],$serieId,$item['name']);
            array_push($listData,$itemObject);
        }
        $mysqli->close();
        return $listData;
    }
    public function store()
    {
        $serieAudioCreated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($resultInsert = $mysqli->query("insert into serieaudio(serieid,languageid) values($this->serieId,$this->languageId)"))
        {
            $serieAudioCreated = true;
        }
        $mysqli->close();
        return $serieAudioCreated;
    }
    public function delete()
    {
        $serieAudioDeleted = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($query = $mysqli->query("delete from serieaudio where serieid='$this->serieId'"))
        {
            $serieAudioDeleted = true;
        }
        $mysqli->close();
        return $serieAudioDeleted;
    }


}