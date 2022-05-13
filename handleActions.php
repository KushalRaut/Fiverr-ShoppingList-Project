<?php
    include("data.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["add"])){
            if($_POST["item"]!=NULL)
            {   
                add_item($_POST["item"]);
            }
        }
        else if(isset($_POST["update"])){
            if($_POST["current_update_items"]!=NULL)
            {
                update_item($_POST["current_update_items"],$_POST["updated_item"]);
            }
           
        }
        else if(isset($_POST["delete"])){
            if($_POST["current_items"]!=NULL)
            {   
                delete_item($_POST["current_items"]);
            }
        }
        else if(isset($_POST["sort"])){
            sort_data();
        }
    }
    header("Location: index.php");
?>