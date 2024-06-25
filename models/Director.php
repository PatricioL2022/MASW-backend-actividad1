<?php
require_once('ConnectionDB.php');
class Director
{
    private $id;
    private $name;
    private $lastname;
    private $birthday;
    private $nationality;
    private $connectionDB;
    /**
     * @param $id
     * @param $name
     * @param $lastname
     * @param $birthday
     * @param $nationality
     */
    public function __construct($id = null, $name = null, $lastname = null, $birthday = null, $nationality = null)
    {
        if ($id != null)
            $this->id = $id;
        if ($name != null)
            $this->name = $name;
        if ($lastname != null)
            $this->lastname = $lastname;
        if ($birthday != null)
            $this->birthday = $birthday;
        if ($nationality != null)
            $this->nationality = $nationality;
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
    public function getLastName()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }
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
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param mixed $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }



    public function getAll()
    {

        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("SELECT id,name,lastname,birthday,nationality FROM director order by id asc");
        $listData = [];
        foreach ($query as $item) {
            $itemObject = new Director($item['id'], $item['name'], $item['lastname'], $item['birthday'], $item['nationality']);
            array_push($listData, $itemObject);
        }
        $mysqli->close();
        return $listData;
    }
    public function getById($directorId)
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("SELECT id,name,lastname,birthday,nationality FROM director where id='$directorId'");
        $itemObject = mysqli_fetch_object($query, Director::class);
        $mysqli->close();
        return $itemObject;
    }
    public function store()
    {
        $directorCreated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if ($resultInsert = $mysqli->query("insert into director(name,lastname,birthday,nationality) values('$this->name','$this->lastname','$this->birthday','$this->nationality')")) {
            $directorCreated = true;
        }
        $mysqli->close();
        return $directorCreated;
    }
    public function update()
    {
        $directorUpdated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if ($mysqli->query("update director set name = '$this->name',lastname = '$this->lastname',
                        birthday = '$this->birthday',nationality = '$this->nationality'where id='$this->id'")) {
            $directorUpdated = true;
        }
        $mysqli->close();
        return $directorUpdated;
    }
    public function delete()
    {
        $directorDeleted = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if ($query = $mysqli->query("delete from director where id='$this->id'")) {
            $directorDeleted = true;
        }
        $mysqli->close();
        return $directorDeleted;
    }
}
