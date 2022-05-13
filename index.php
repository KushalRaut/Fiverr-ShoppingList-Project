<?php
    include("data.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping List Manager</title>
    <style> <?php include 'styles.css'; ?> </style>
</head>
<body>
    <header>
        <h1>Shopping List Manager</h1>
        <hr />
    </header>

    <main>

        <!-- First section of you page will display all the list items -->
        <section class="section_one">
            <h2>Items:</h2>
            <?php
            $items = get_items();
            for ($x = 0; $x < count($items); $x++) {
                echo "<p>";
                echo $items[$x]->item_id;
                echo ". ";
                echo $items[$x]->item_name;
                echo "</p>";
            }
            ?>
        </section> 
        
        <!-- Second section of you page contains add item field and button  -->
        <section class="section_two">
            <h2>Add Item:</h2>
            <form action="handleActions.php" method="post">
                <label for="add_item">Item:</label>
                <input type="text" name="item" id="add_item" placeholder="Item Name" />
                <br/>
                <button type="submit" name="add" id="add_item">Add Item</button>
            </form>
        </section>
        
        <!-- Third section of you page will allow users to update or delete items -->
        <section class="section_three">
            <!-- <?php
            $update = getUpdateState();
            echo var_dump($update);
            setUpdateState();
            $update = getUpdateState();
            echo var_dump($update);
            
            echo "<button onClick={}></button>";


            ?> -->

            <div>
            <h2>Update Item:</h2>
            <form action="handleActions.php" method="post">
                <label for="update_item">Select Item:</label>
                <select id="update_item" name="current_update_items">
                <?php

                    $items = get_items();
                    for ($x = 0; $x < count($items); $x++) {
                    // Display all the items in a dropdown menu
                        $item_name = $items[$x]->item_name;
                        echo "<option>$item_name</option>";                 
                    }
                ?>
                </select>
                <br/>
                <label for="updated_text">Updated Name:</label>
                <input type="text" name="updated_item" id="updated_item" placeholder="Updated Name" />
                <br/>
                <button type="submit" name="update" id="update_item">Update Item</button>
            </form>
            </div>

            <div>
            <h2>Delete Item:</h2>
            <form action="handleActions.php" method="post">
                <label for="delete_item">Item:</label>
                <select id="delete_item" name="current_items">
                <?php

                    $items = get_items();
                    for ($x = 0; $x < count($items); $x++) {
                    // Display all the items in a dropdown menu
                        $item_name = $items[$x]->item_name;
                        echo "<option>$item_name</option>";                 
                    }
                    ?>
                </select>
                <br/>
                <button type="submit" name="delete" id="delete_item">Delete Item</button>
            </form>
            </div>

        </section> 
        
        <!-- Fourth section of you page will allow users to sort the shopping list -->
        <section class="section_four">
            <form action="handleActions.php" method="post">
                <button type="submit" name="sort" id="sort_item">Sort Items</button>
            </form>
        </section>  
    </main>

    <footer>
    </footer>
</body>
</html>