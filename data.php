<?php

    // Function to make connection with the Database
    function make_connection()
    {
        $host='localhost';
        $user='root';
        $password='';
        $dbname='shoppinglist';
        $con = new mysqli($host,$user,$password,$dbname);
        if($con->connect_error){
            echo "Connection failed : ".$con->connect_error;
        
        }
        return $con;
    }

    // Creating a data structure to store values from the database
    class list_item
    {
        public $item_id;
        public $item_name;

        public function __construct($item_id, $item_name)
        {
            $this->item_id = $item_id;
            $this->item_name = $item_name;
        }
    }


    // Function to get all the items from the database and store it in a array
    function get_items()
    {
        $con = make_connection();
        $sql = "SELECT * FROM listitems";
        $result = $con->query($sql);
        $items = array();
        $i=1;
        while($row = $result->fetch_assoc()){
            $item = new list_item($i,$row["name"]);
            array_push($items,$item);
            $i++;
        }
        return $items;
    }

    // Function to add a new item to the database
    function add_item($name)
    {
        $allItems = get_items();
        $dublicate = false;
        for ($x = 0; $x < count($allItems); $x++) {
            if($allItems[$x]->item_name == $name)
            {
                $dublicate = true;
            }
        }
        if($dublicate)
        {
            header("Location: errorPage.php");
        }else if(!$dublicate){

            $con = make_connection();
            $sql = "INSERT INTO listitems(name) VALUES('$name')";
            $con->query($sql);
        }
    }

    // Function to update an item from the database
    function update_item($current_name,$updated_name){
        print($current_name);
        print($updated_name);
        $allItems = get_items();
        $dublicate = false;
        for ($x = 0; $x < count($allItems); $x++) {
            if($allItems[$x]->item_name == $updated_name)
            {
                $dublicate = true;
            }
            
        }
        if($dublicate)
        {
            header("Location: errorPage.php");
        }else if(!$dublicate){
            $con = make_connection();
            $sql = "UPDATE listitems SET name = '$updated_name' WHERE name = '$current_name'";
            $con->query($sql);
        }
    }

    // Function to delete an item from the database
    function delete_item($name){
        $con = make_connection();
        $sql = "DELETE FROM listitems WHERE name='$name'";
        $con->query($sql);
    }


    // Function to sort the items in the database
    function sort_data(){
        $con = make_connection();
        $sql = "SELECT * FROM listitems ORDER BY name";
        $result = $con->query($sql);
        $items = array();
        $i=1;
        while($row = $result->fetch_assoc()){
            $item = new list_item($i,$row["name"]);
            array_push($items,$item);
            $i++;
        }

        $sql = "DROP TABLE listitems";
        $con->query($sql);

        $sql = "CREATE TABLE listitems(name VARCHAR(250))";
        $con->query($sql);

        for ($x = 0; $x < count($items); $x++) {
            $item_name =  $items[$x]->item_name;
            if(strlen($item_name) > 0)
            {
                $sql = "INSERT INTO listitems(name) VALUES('$item_name')";
                $con->query($sql); 
            }
        }
    }
?>