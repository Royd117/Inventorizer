<?php

class Category
{
    // database comm line and table name
    public $comm;
    public $table_name = "categories";

    // table fields
    public $id;
    public $name;
    public $stash;
    public $deleted;

    public function __construct($db)
    {
        $this->comm = $db;
    }

    function create(){
      
        // insertion query
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, stash=:stash, deleted=0";
      
        $statement = $this->comm->prepare($query);
      
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->stash=htmlspecialchars(strip_tags($this->stash));
      
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":stash", $this->stash);
        
        if($statement->execute()) return true;
      
        return false;
          
    }

    function read(){
      
        // single-reading query
        $query = "SELECT name, stash, deleted
            FROM " . $this->table_name . " WHERE name = :name LIMIT 0,1";
      
        $statement = $this->comm->prepare($query);
        
        $statement->bindParam(":name", $this->name);
      
        $statement->execute();

        $item = $statement->fetch(PDO::FETCH_ASSOC);

        if($item) {
            $this->id = $item['id'];
            $this->name = $item['name'];
            $this->stash = $item['stash'];
            $this->deleted = $item['deleted'];
        }

    }

    function update(){
      
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    stash = :stash
                WHERE
                    id = :id";
      
        $statement = $this->comm->prepare($query);
      
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->stash=htmlspecialchars(strip_tags($this->stash));
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":stash", $this->stash);
        $statement->bindParam(":id", $this->id);
      
        if($statement->execute()) return true;
      
        return false;
    }

    function delete() {

        // "delete" query
        $query = "UPDATE " . $this->table_name . " SET deleted = 1 WHERE id = :id";
        $query2 = "UPDATE items SET deleted = 1 WHERE category = :id";
      
        $statement = $this->comm->prepare($query);
        $statement2 = $this->comm->prepare($query2);
      
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        $statement->bindParam(":id", $this->id);
        $statement2->bindParam(":id", $this->id);
      
        if($statement->execute() && $statement2->execute()) return true;
      
        return false;
    }

    function search($param,$usr){

        if(empty($param))
            $query = "SELECT categories.id, categories.name, categories.stash, stashes.id as stid, user FROM " . $this->table_name . ", stashes WHERE categories.stash = stashes.id AND user = ".$usr." AND categories.deleted = 0";
        else
            $query = "SELECT categories.id, categories.name, categories.stash, stashes.id as stid, user
                FROM " . $this->table_name . ", stashes WHERE categories.stash = stashes.id AND categories.name LIKE '%" . $this->name . "%' AND user = ".$usr." AND categories.deleted = 0";

        $statement = $this->comm->prepare($query);

        $statement->execute();

        $item = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $item;

        /*$this->deleted = $item['deleted'];
        $this->username = $item['username'];
        $this->email = $item['email'];
        $this->displayname = $item['displayname'];*/

    }

    function filter($param,$stid){

        if(empty($param))
            $query = "SELECT * FROM " . $this->table_name . " WHERE stash = " . $stid . " AND deleted = 0;";
        else
            $query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE '%" . $this->name . "%' AND stash = " . $stid . " AND deleted = 0";

        $statement = $this->comm->prepare($query);

        $statement->execute();

        $item = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $item;

        /*$this->deleted = $item['deleted'];
        $this->username = $item['username'];
        $this->email = $item['email'];
        $this->displayname = $item['displayname'];*/

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
    public function getStash()
    {
        return $this->stash;
    }

    /**
     * @param mixed $stash
     */
    public function setStash($stash)
    {
        $this->stash = $stash;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

}