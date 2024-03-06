<?php
require('/model/database.php');
require('/model/item_db.php');
require('/model/category_db.php');
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_items';
    }
}

if ($action == 'list_items') {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $items = get_items_by_category($category_id);
    include('category_db.php');
}

else if ($action == 'delete_item') {
    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE || $item_id == NULL || $item_id == FALSE) {
        $error = "Missing or incorrect item id or category id.";
        include('/view/error.php');
    }
    else { 
        delete_item($item_id);
        header("Location: .?category_id=$category_id");
        }
} 

else if ($action == 'show_add_form') {
    $categories = get_categories();
    include('category_db.php');
}

else if ($action == 'add_item') {
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    if ($category_id == NULL || $category_id == FALSE || $code == NULL || $name == NULL) {
        $error = "Invalid item data. Check all fields and try again.";
        include('/view/error.php');
    }
    else {
    add_item($category_id, $code, $name);
    header("Location: .?category_id=$category_id");
    }
}

else if ($action == 'add category'){
    $category = new add_categories($name);
    include('category_db.php');
}

else if ($action == 'delete category'){
    delete_categories($category_id);
}
?>