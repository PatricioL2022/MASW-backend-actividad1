<?php

require_once('ConnectionDB.php');
class Language {
    private $id;
    private $name;
    private $isocode;
    private $connectionDB;
    /**
     * @param $id
     * @param $name
     * @param $isocode
     */
    public function __construct($id=null, $name=null, $isocode=null)
    {
        if($id!=null)
            $this->id = $id;
        if($name!=null)
            $this->name = $name;
        if($isocode!=null)
            $this->isocode = $isocode;
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
    public function getIsocode()
    {
        return $this->isocode;
    }

    /**
     * @param mixed $isocode
     */
    public function setIsocode($isocode)
    {
        $this->isocode = $isocode;
    }

    public function getAll()
    {
        //$connectionDB = new ConnectionDB();
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("SELECT id, name, isocode FROM language order by id asc");
        $listData = [];
        foreach ($query as $item)
        {
            $itemObject = new Language($item['id'],$item['name'],$item['isocode']);
            array_push($listData,$itemObject);
        }
        $mysqli->close();
        return $listData;
    }
    public function getById($Id)
    {
        $mysqli = $this->connectionDB->initConnectionDb();
        $query = $mysqli->query("SELECT id,name, isocode FROM language where id='$Id'");
        $itemObject = mysqli_fetch_object($query,Language::class);
        $mysqli->close();
        return $itemObject;
    }
    public function insert()
    {
        $actformCreated = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($resultInsert = $mysqli->query("insert into language(name,isocode) values('$this->name','$this->isocode')"))
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
        if($mysqli->query("update language set name = '$this->name', isocode = '$this->isocode' where id='$this->id'"))
        {
            $actUpdated = true;
        }
        $mysqli->close();
        return $actUpdated;
    }
    public function delete()
    {
        $languageDeleted = false;
        $mysqli = $this->connectionDB->initConnectionDb();
        if($query = $mysqli->query("DELETE FROM serieaudio WHERE languageavailableaudio = '$this->id'"))
        {
            if($query = $mysqli->query("DELETE FROM seriesubtitle WHERE languageavailablesubtitle='$this->id'"))
            {
                if($query = $mysqli->query("DELETE FROM language WHERE id='$this->id'"))
                {
                    $languageDeleted = true;
                }
            }
        }
        $mysqli->close();
        return $languageDeleted;
    }
}
?>