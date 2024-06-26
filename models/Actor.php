<?php

require_once('ConnectionDB.php');
class Actor {
    private $id;
    private $name;
    private $lastname;
    private $birthday;
    private $connectionDB;
    /**
     * @param $id
     * @param $name
     * @param $lastname
     * @param $birthday
     */
    public function __construct($id=null, $name=null, $lastname=null, $birthday=null)
    {
        if($id!=null)
            $this->id = $id;
        if($name!=null)
            $this->name = trim($name);
        if($lastname!=null)
            $this->lastname = trim($lastname);
        if($birthday!=null)
            $this->birthday = $birthday;
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


    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }


    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getAll()
    {
        //$connectionDB = new ConnectionDB();
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("SELECT id, name, lastname, birthday FROM actor order by id asc");
        $listData = [];
        foreach ($query as $item)
        {
            $itemObject = new Actor($item['id'],$item['name'],$item['lastname'],$item['birthday']);
            array_push($listData,$itemObject);
        }
        $mysqli->close();
        return $listData;
    }
    public function getById($actformId)
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("SELECT id,name, lastname, birthday FROM actor where id='$actformId'");
        $itemObject = mysqli_fetch_object($query,Actor::class);
        $mysqli->close();
        return $itemObject;
    }
    public function insert()
    {
        $actformCreated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($resultInsert = $mysqli->query("insert into actor(name,lastname, birthday) values('$this->name','$this->lastname','$this->birthday')"))
        {
            $actformCreated = true;
        }
        $mysqli->close();
        return $actformCreated;
    }
    public function update()
    {
        $actUpdated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($mysqli->query("update actor set name = '$this->name', lastname = '$this->lastname', birthday = '$this->birthday' where id='$this->id'"))
        {
            $actUpdated = true;
        }
        $mysqli->close();
        return $actUpdated;
    }
    public function delete()
    {
        $actDeleted = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($query = $mysqli->query("DELETE FROM serieactor WHERE actorid = '$this->id'"))
        {
            if($query = $mysqli->query("DELETE FROM actor WHERE id='$this->id'"))
            {
                $actDeleted = true;
            }
        }
        $mysqli->close();
        return $actDeleted;
    }
}
?>