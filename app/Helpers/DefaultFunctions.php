<?php

use App\Models\Category;

/**
* Get Category Name by Id
*/
function getCategoryNameById($id)
{
    $data = Category::find($id);
    return $data->name;
}