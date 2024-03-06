<?php
//Search by category
function get_items_by_category($category_id) {
    global $db;
    if ($category_id == NULL || $category_id == FALSE) {
        $query = 'SELECT * FROM todo_items
        WHERE $category_id IS NULL OR $category_id = FALSE';
    }
    $query = 'SELECT * FROM 
    WHERE items.categoryID = :category_id ORDER BY itemID';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id); $statement->execute();
    $item = $statement->fetchAll(); $statement->closeCursor();
    return $item;
}

//Search for a task
function get_items($items_id) { 
    global $db;
    $query = 'SELECT * FROM items WHERE itemID = :items_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':items_id', $items_id); $statement->execute();
    $items = $statement->fetch();
    $statement->closeCursor(); return $items;
}

//Delete items
function delete_items($items_id) {
    require_once('database.php');

    // Get IDs
    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    
    // Delete the item from the database
    if ($item_id != false && $category_id != false) {
        $query = 'DELETE FROM items
                  WHERE itemID = :item_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':item_id', $item_id);
        $success = $statement->execute();
        $statement->closeCursor();    
    }
    

}

//Add items
function add_items($db, $table, $data){
    // Get the item data
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    // Validate inputs
    if ($category_id == null || $category_id == false ||
            $code == null || $name == null || $price == null || $price == false) {
        $error = "Invalid item data. Check all fields and try again.";
        include('error.php');
    } else {
        require_once('database.php');

        // Add items to the database  
        $query = 'INSERT INTO items
                    (categoryID, itemCode, itemName, listPrice)
                VALUES
                    (:category_id, :code, :name, :price)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->execute();
        $statement->closeCursor();
    }
}
    // Display to the To Do List page
    include('index.php');
?>