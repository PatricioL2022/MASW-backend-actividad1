<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 22/6/2024
 * Time: 18:08
 */

class SerieSubtitle
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

    public function getSubtitlesAvailableBySerie($serieId)
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("select lg.id,lg.name from seriesubtitle sb inner join language lg on sb.languageid = lg.id inner join serie se on sb.serieid = se.id where se.id = $serieId order by sb.id asc");
        $listData = [];
        foreach ($query as $item)
        {
            $itemObject = new SerieSubtitle(null,$item['id'],$serieId,$item['name']);
            array_push($listData,$itemObject);
        }
        $mysqli->close();
        return $listData;
    }
    public function store()
    {
        $serieSubtitleCreated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($resultInsert = $mysqli->query("insert into seriesubtitle(serieid,languageid) values($this->serieId,$this->languageId)"))
        {
            $serieSubtitleCreated = true;
        }
        $mysqli->close();
        return $serieSubtitleCreated;
    }
}