<?php

class Stash
{
    // database comm line and table name
    public $comm;
    public $table_name = "stashes";

    // table fields
    public $id;
    public $name;
    public $location;
    public $user;
    public $deleted;

    public function __construct($db)
    {
        $this->comm = $db;
    }

    function create(){
      
        // insertion query
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, location=:location, user=:user, deleted=0";
      
        $statement = $this->comm->prepare($query);
      
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->user=htmlspecialchars(strip_tags($this->user));
        $this->location=htmlspecialchars(strip_tags($this->location));
      
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":user", $this->user);
        $statement->bindParam(":location", $this->location);
        
        if($statement->execute()) return true;
      
        return false;
          
    }

    function read(){
      
        // single-reading query
        $query = "SELECT name, location, deleted
            FROM " . $this->table_name . " WHERE name = :name LIMIT 0,1";
      
        $statement = $this->comm->prepare($query);
        
        $statement->bindParam(":name", $this->name);
      
        $statement->execute();

        $item = $statement->fetch(PDO::FETCH_ASSOC);

        if($item) {
            $this->id = $item['id'];
            $this->name = $item['name'];
            $this->user = $item['user'];
            $this->location = $item['location'];
            $this->deleted = $item['deleted'];
        }

    }

    function update(){
      
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    location = :location
                WHERE
                    id = :id";
      
        $statement = $this->comm->prepare($query);
      
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->location=htmlspecialchars(strip_tags($this->location));
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":location", $this->location);
        $statement->bindParam(":id", $this->id);
      
        if($statement->execute()) return true;
      
        return false;
    }

    function delete() {

        // "delete" query
        $query = "UPDATE " . $this->table_name . " SET deleted = 1 WHERE id = :id";
        $query2 = "UPDATE categories SET deleted = 1 WHERE stash = :id";
        $query3 = "UPDATE items SET deleted = 1 WHERE items.category in (SELECT categories.id FROM stashes, categories WHERE categories.stash = stashes.id AND stashes.id = :id)";
      
        $statement = $this->comm->prepare($query);
        $statement2 = $this->comm->prepare($query2);
        $statement3 = $this->comm->prepare($query3);
      
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        $statement->bindParam(":id", $this->id);
        $statement2->bindParam(":id", $this->id);
        $statement3->bindParam(":id", $this->id);
      
        if($statement->execute() && $statement2->execute() && $statement3->execute()) return true;
      
        return false;
    }

    function search($param,$usr){

        if(empty($param))
            $query = "SELECT  * FROM " . $this->table_name . " WHERE user = " . $usr . " AND deleted = 0";
        else
            $query = "SELECT  *
                FROM " . $this->table_name . " WHERE name LIKE '%" . $this->name . "%' AND user = " . $usr . " AND deleted = 0";

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
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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