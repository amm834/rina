<?php

/* Routtes For Web */

use App\Routing;
use App\Routing\RouterDispatcher;

$router = new AltoRouter();

// Set Base Path Of Home Route

$router->setBasePath('/E-Commerence/public');

// method,uri,controller,route name

//User Route

$router->map('GET', '/user/login', 'App\Controllers\UserController@show', 'User Login Form Route');
$router->map('POST', '/user/login', 'App\Controllers\UserController@login', 'User Login Route');
$router->map('GET', '/user/logout', 'App\Controllers\UserController@logout', 'User Logout Route');
// Create
$router->map('GET', '/user/register', 'App\Controllers\UserController@registerForm', 'User registerForm Route');
$router->map('POST', '/user/register', 'App\Controllers\UserController@register', 'User register Route');


// Home Route
$router->map('GET', '/', 'App\Controllers\IndexController@show', 'Home Route');

$router->map('POST', '/cart', 'App\Controllers\IndexController@cart', 'Cart Route');
$router->map('GET', '/cart/show', 'App\Controllers\IndexController@showCarts', 'Cart Show Route');
$router->map('POST', '/cart/checkout', 'App\Controllers\IndexController@checkout', 'Check Out');

//Admin Home
$router->map('GET', '/admin', 'App\Controllers\AdminController@index', 'Admin Home');

// Admin Category
$router->map('GET', '/admin/category/create', 'App\Controllers\CategoryController@show', 'Category Route');
$router->map('POST', '/admin/category/create', 'App\Controllers\CategoryController@store', 'Category Store');
$router->map('GET', '/admin/category/[i:id]/delete', 'App\Controllers\CategoryController@delete', 'Category Delete');
$router->map('POST', '/admin/category/[i:id]/update', 'App\Controllers\CategoryController@update', 'Category Update');

$router->map('POST', '/admin/subcategory/[i:id]/update', 'App\Controllers\SubCategoryController@update', 'SubCategory Update');
$router->map('GET', '/admin/subcategory/[i:id]/delete', 'App\Controllers\SubCategoryController@delete', 'SubCategory Delete');
$router->map('POST', '/admin/sub-category/create', 'App\Controllers\SubCategoryController@store', 'Sub Category Create');
$router->map('GET', '/admin/product/show', 'App\Controllers\ProductController@show', 'Product Show');
$router->map('GET', '/admin/product/create', 'App\Controllers\ProductController@create', 'Product Create');
$router->map('POST', '/admin/product/create', 'App\Controllers\ProductController@store', 'Product Store');
$router->map('GET', '/admin/product/[i:id]/edit', 'App\Controllers\ProductController@edit', 'Product Edit');
$router->map('POST', '/admin/product/[i:id]/edit', 'App\Controllers\ProductController@update', 'Product Upadte');
$router->map('GET', '/admin/product/[i:id]/delete', 'App\Controllers\ProductController@delete', 'Product Delete');

$router->map('GET', '/product/[i:id]/detail', 'App\Controllers\ProductController@detail', 'Product Detail');


new RouterDispatcher($router);
