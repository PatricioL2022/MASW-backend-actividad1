<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 22/6/2024
 * Time: 15:31
 */
require_once('ConnectionDB.php');
class SerieActor
{
    private $id;
    private $serieid;
    private $actorid;
    private $actorname;
    private $connectionDB;
    /**
     * @return mixed
     */
    public function getActorname()
    {
        return $this->actorname;
    }

    /**
     * @param mixed $actorname
     */
    public function setActorname($actorname)
    {
        $this->actorname = $actorname;
    }

    /**
     * @param $id
     * @param $serieid
     * @param $actorid
     */
    public function __construct($id=null, $serieid=null, $actorid=null,$actorname=null)
    {
        if($id!=null)
            $this->id = $id;
        if($serieid!=null)
            $this->serieid = $serieid;
        if($actorid!=null)
            $this->actorid = $actorid;
        if($actorname!=null)
            $this->actorname = $actorname;
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
    public function getActorid()
    {
        return $this->actorid;
    }

    /**
     * @param mixed $actorid
     */
    public function setActorid($actorid)
    {
        $this->actorid = $actorid;
    }

    /**
     * @return mixed
     */
    public function getSerieid()
    {
        return $this->serieid;
    }

    /**
     * @param mixed $serieid
     */
    public function setSerieid($serieid)
    {
        $this->serieid = $serieid;
    }
    public function getActorsBySerie($serieId)
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("select sa.actorid,concat(ac.name,' ',ac.lastname) as actorname from serieactor sa inner join actor ac on sa.actorid = ac.id inner join serie se on sa.serieid = se.id where se.id = $serieId order by ac.id asc");
        $listData = [];
        foreach ($query as $item)
        {
            $itemObject = new SerieActor(null,$serieId,$item['actorid'],$item['actorname']);
            array_push($listData,$itemObject);
        }
        $mysqli->close();
        return $listData;
    }
    public function store()
    {
        $serieActorCreated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($resultInsert = $mysqli->query("insert into serieactor(serieid, actorid) values($this->serieid,$this->actorid)"))
        {
            $serieActorCreated = true;
        }
        $mysqli->close();
        return $serieActorCreated;
    }


}