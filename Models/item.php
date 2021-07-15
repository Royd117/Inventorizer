<?php

class Item
{
    // database comm line and table name
    public $comm;
    public $table_name = "items";

    // table fields
    public $id;
    public $name;
    public $category;
    public $description;
    public $quantity;
    public $status;
    public $deleted;

    public function __construct($db)
    {
        $this->comm = $db;
    }

    function create(){
      
        // insertion query
        $query = "INSERT INTO " . $this->table_name . " 
            SET name=:name, category=:category, description=:description, quantity=:quantity, status=:status, deleted=0";
      
        $statement = $this->comm->prepare($query);
      
        $this->imageid=htmlspecialchars(strip_tags($this->quantity));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->category=htmlspecialchars(strip_tags($this->category));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->status=htmlspecialchars(strip_tags($this->status));
      
        $statement->bindParam(":quantity", $this->quantity);
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":category", $this->category);
        $statement->bindParam(":description", $this->description);
        $statement->bindParam(":status", $this->status);
        
        if($statement->execute()) return true;
      
        return false;
          
    }

    function read(){
      
        // single-reading query
        $query = "SELECT name, category, description, quantity, status, deleted
            FROM " . $this->table_name . " WHERE name = :name LIMIT 0,1";
      
        $statement = $this->comm->prepare($query);
        
        $statement->bindParam(":name", $this->name);
      
        $statement->execute();

        $item = $statement->fetch(PDO::FETCH_ASSOC);

        if($item) {
            $this->id = $item['id'];
            $this->name = $item['name'];
            $this->category = $item['category'];
            $this->description = $item['description'];
            $this->quantity = $item['quantity'];
            $this->status = $item['status'];
            $this->deleted = $item['deleted'];
        }

    }

    function update(){
      
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    category = :category,
                    description = :description,
                    quantity = :quantity,
                    status = :status
                WHERE
                    id = :id";
      
        $statement = $this->comm->prepare($query);
      
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->category=htmlspecialchars(strip_tags($this->category));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->quantity=htmlspecialchars(strip_tags($this->quantity));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        $statement->bindParam(":quantity", $this->quantity);
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":category", $this->category);
        $statement->bindParam(":description", $this->description);
        $statement->bindParam(":status", $this->status);
        $statement->bindParam(":id", $this->id);
      
        if($statement->execute()) return true;
      
        return false;
    }

    function delete() {

        // "delete" query
        $query = "UPDATE " . $this->table_name . " SET deleted = 1 WHERE id = :id";
      
        $statement = $this->comm->prepare($query);
      
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        $statement->bindParam(":id", $this->id);
      
        if($statement->execute()) return true;
      
        return false;
    }

    function search($param,$usr){

        if(empty($param))
            $query = "SELECT items.id, items.name, items.category, description, items.status, quantity, categories.id as catid, categories.stash, stashes.id as stid, user FROM " . $this->table_name . ", categories, stashes WHERE categories.stash = stashes.id AND items.category = categories.id AND user = ".$usr." AND items.deleted = 0";
        else
            $query = "SELECT items.id, items.name, items.category, description, items.status, quantity, categories.id as catid, categories.stash, stashes.id as stid, user FROM " . $this->table_name . ", categories, stashes WHERE categories.stash = stashes.id AND items.category = categories.id AND items.name LIKE '%" . $this->name . "%' AND user = ".$usr." AND items.deleted = 0";

        $statement = $this->comm->prepare($query);

        $statement->execute();

        $item = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $item;

        /*$this->deleted = $item['deleted'];
        $this->username = $item['username'];
        $this->email = $item['email'];
        $this->displayname = $item['displayname'];*/

    }

    function filter($param,$catid){

        if(empty($param))
            $query = "SELECT * FROM " . $this->table_name . " WHERE category = " . $catid . " AND deleted = 0;";
        else
            $query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE '%" . $this->name . "%' AND category = " . $catid . " AND deleted = 0";

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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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