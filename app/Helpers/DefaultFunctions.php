<?php

use App\Models\Category;
use App\Models\PostStatus;
use Spatie\Permission\Models\Role;

/**
* Get Category Name by Id
*/
function getCategoryNameById($id)
{
    $data = Category::find($id);
    return $data->name;
}

/**
 * Get Role Name by Id
 */
function getRoleNameById($id)
{
    $data = Role::find($id);
    return ucwords($data->name);
}

/**
 * Get Post Status Name by Id
 */
function getPostStatusNameById($id)
{
    $data = PostStatus::find($id);
    return $data->name;
}