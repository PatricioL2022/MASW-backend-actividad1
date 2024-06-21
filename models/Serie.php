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
private $directorid;
private $connectionDB;

    /**
     * @param $id
     * @param $title
     * @param $platformid
     * @param $directorid
     */
    public function __construct($id=null, $title=null, $platformid=null, $directorid=null)
    {
        if($id!=null)
            $this->id = $id;
        if($title!=null)
            $this->title = $title;
        if($platformid!=null)
            $this->platformid = $platformid;
        if($directorid!=null)
        $this->directorid = $directorid;
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

    public function getAll()
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("select s.id,s.title,p.name as platform,concat(d.name,' ',d.lastname) as director from serie s inner join platform p on s.platformid = p.id inner join director d on s.directorid = d.id order by s.id asc");
        $listData = [];
        foreach ($query as $item)
        {
            $itemObject = new Serie($item['id'],$item['title'],$item['platform'],$item['director']);
            array_push($listData,$itemObject);
        }
        $mysqli->close();
        return $listData;
    }

}