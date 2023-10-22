<?php

use App\Models\Category;
use App\Models\Post;
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

/**
 * Count Post by Category Id
 */
function countPostByCategoryId($categoryIds)
{
    // Check if $categoryIds is an array
    if (is_array($categoryIds)) {
        // It's already an array, so use it as is
        $categoryIdsArray = $categoryIds;
    } else {
        // Convert the comma-separated string to an array of IDs
        $categoryIdsArray = explode(',', $categoryIds);
    }

    $data = Post::whereIn('category_id', $categoryIdsArray)->count();

    return $data;
}
