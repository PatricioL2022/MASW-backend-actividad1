<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 17/6/2024
 * Time: 23:38
 */
require_once('ConnectionDB.php');
class Platform {
    private $id;
    private $name;
    private $connectionDB;
    /**
     * @param $id
     * @param $name
     */
    public function __construct($id=null, $name=null)
    {
        if($id!=null)
            $this->id = $id;
        if($name!=null)
            $this->name = $name;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



    public function getAll()
    {
        //$connectionDB = new ConnectionDB();
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("SELECT* FROM platform order by id asc");
        $listData = [];
        foreach ($query as $item)
        {
            $itemObject = new Platform($item['id'],$item['name']);
            array_push($listData,$itemObject);
        }
        $mysqli->close();
        return $listData;
    }
    public function getById($platformId)
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("SELECT* FROM platform where id='$platformId'");
        $itemObject = mysqli_fetch_object($query,Platform::class);
        $mysqli->close();
        return $itemObject;
    }
    public function store()
    {
        $platformCreated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($resultInsert = $mysqli->query("insert into platform(name) values('$this->name')"))
        {
            $platformCreated = true;
        }
        $mysqli->close();
        return $platformCreated;
    }
    public function update()
    {
        $platformUpdated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($mysqli->query("update platform set name = '$this->name' where id='$this->id'"))
        {
            $platformUpdated = true;
        }
        $mysqli->close();
        return $platformUpdated;
    }
    public function delete()
    {
        $platformDeleted = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($query = $mysqli->query("delete from platform where id='$this->id'"))
        {
            $platformDeleted = true;
        }
        $mysqli->close();
        return $platformDeleted;
    }
}
?>