<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 19/6/2024
 * Time: 21:42
 */
require_once('ConnectionDB.php');
class Serie
{
private $id;
private $title;
private $platformid;
private $platformname;
private $directorid;
private $directorname;
private $connectionDB;
private $actors;
private $languageAudioAvailable;
private $languageSubtitleAvailable;

    /**
     * @param $id
     * @param $title
     * @param $platformid
     * @param $directorid
     */
    public function __construct($id=null, $title=null, $platformid=null,$platformname=null,
                                $directorid=null,$directorname=null,$actors=null,$languageAudioAvailable=null,$languageSubtitleAvailable=null)
    {
        if($id!=null)
            $this->id = $id;
        if($title!=null)
            $this->title = trim($title);
        if($platformid!=null)
            $this->platformid = $platformid;
        if($platformname!=null)
            $this->platformname = $platformname;
        if($directorid!=null)
            $this->directorid = $directorid;
        if($directorname!=null)
            $this->directorname = $directorname;
        if($actors!=null)
            $this->actors = $actors;
        if($languageAudioAvailable!=null)
            $this->languageAudioAvailable = $languageAudioAvailable;
        if($languageSubtitleAvailable!=null)
            $this->languageSubtitleAvailable = $languageSubtitleAvailable;
        $this->connectionDB = new ConnectionDB();
    }

    /**
     * @return mixed
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param mixed $actors
     */
    public function setActors($actors)
    {
        $this->actors = $actors;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPlatformid()
    {
        return $this->platformid;
    }

    /**
     * @param mixed $platformid
     */
    public function setPlatformid($platformid)
    {
        $this->platformid = $platformid;
    }

    /**
     * @return mixed
     */
    public function getDirectorid()
    {
        return $this->directorid;
    }

    /**
     * @param mixed $directorid
     */
    public function setDirectorid($directorid)
    {
        $this->directorid = $directorid;
    }

    /**
     * @return mixed
     */
    public function getLanguageAudioAvailable()
    {
        return $this->languageAudioAvailable;
    }

    /**
     * @param mixed $languageAudioAvailable
     */
    public function setLanguageAudioAvailable($languageAudioAvailable)
    {
        $this->languageAudioAvailable = $languageAudioAvailable;
    }

    /**
     * @return mixed
     */
    public function getLanguageSubtitleAvailable()
    {
        return $this->languageSubtitleAvailable;
    }

    /**
     * @param mixed $languageSubtitleAvailable
     */
    public function setLanguageSubtitleAvailable($languageSubtitleAvailable)
    {
        $this->languageSubtitleAvailable = $languageSubtitleAvailable;
    }

    /**
     * @return mixed
     */
    public function getPlatformname()
    {
        return $this->platformname;
    }

    /**
     * @param mixed $platformname
     */
    public function setPlatformname($platformname)
    {
        $this->platformname = $platformname;
    }

    /**
     * @return mixed
     */
    public function getDirectorname()
    {
        return $this->directorname;
    }

    /**
     * @param mixed $directorname
     */
    public function setDirectorname($directorname)
    {
        $this->directorname = $directorname;
    }

    public function getAll()
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("select s.id,s.title,p.name as platform,concat(d.name,' ',d.lastname) as director from serie s left join platform p on s.platformid = p.id left join director d on s.directorid = d.id order by s.id asc");
        $listData = [];
        foreach ($query as $item)
        {
            $itemObject = new Serie($item['id'],$item['title'],null,$item['platform'],null,$item['director']);
            array_push($listData,$itemObject);
        }
        $mysqli->close();
        return $listData;
    }
    public function getById($serieId)
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("select s.id,s.title,s.platformid,pl.name platformname,s.directorid,concat(dr.name,' ',dr.lastname) directorname from serie s left join director dr on s.directorid = dr.id left join platform pl on s.platformid = pl.id where s.id = $serieId order by s.id asc");
        $itemObject = mysqli_fetch_object($query,Serie::class);
        $mysqli->close();
        return $itemObject;
    }
    public function getLastId()
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("select nullif(max(id),1) as id from serie");
        $itemObject = mysqli_fetch_object($query,Serie::class);
        $mysqli->close();
        return $itemObject;
    }
    public function store()
    {
        $platformCreated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($resultInsert = $mysqli->query("insert into serie(title,platformid,directorid) values('$this->title',$this->platformid,$this->directorid)"))
        {
            $platformCreated = true;
        }
        $mysqli->close();
        return $platformCreated;
    }

    public function update()
    {
        $serieUpdated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($mysqli->query("update serie set title = '$this->title',platformid='$this->platformid',directorid='$this->directorid' where id='$this->id'"))
        {
            $serieUpdated = true;
        }
        $mysqli->close();
        return $serieUpdated;
    }
    public function delete()
    {
        $serieDeleted = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($query = $mysqli->query("delete from serie where id='$this->id'"))
        {
            $serieDeleted = true;
        }
        $mysqli->close();
        return $serieDeleted;
    }

}