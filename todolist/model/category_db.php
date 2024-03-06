<?php
// Add categories
function add_categories($name){
    // Get the category data
    $name = filter_input(INPUT_POST, 'name');

    // Validate inputs
    if ($name == null) {
        $error = "Invalid category data. Check all fields and try again.";
        include('error.php');
    } else {
        require_once('database.php');

        // Add the item to the database  
        $query = 'INSERT INTO categories (categoryName)
                VALUES (:category_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $name);
        $statement->execute();
        $statement->closeCursor();
    }
}

//Delete catgories
function delete_categories($category_id){
    // Get ID
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

    // Validate inputs
    if ($category_id == null || $category_id == false) {
        $error = "Invalid category ID.";
        include('error.php');
    } else {
        require_once('database.php');

        // Add the item to the database  
        $query = 'DELETE FROM categories 
                WHERE categoryID = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    }
}

//Search for category by name
function get_category_name($category_id) {
    global $db;
    $query = 'SELECT * FROM categories
              WHERE categoryID = :category_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();    
    $category = $statement->fetch();
    $statement->closeCursor();    
    $category_name = $category['categoryName'];
    return $category_name;
}

//Getter for categories
function get_categories() {
    global $db;
    $query = 'SELECT * FROM categories
              ORDER BY categoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;    
}

// Display to the To Do List page
include('index.php');
?>