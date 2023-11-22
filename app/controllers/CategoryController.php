<?php

namespace App\Controllers;

use App\Classes\Request;
use App\Classes\CSRF;
use App\Classes\Redirect;
use App\Classes\Validator;
use App\Classes\Session;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends BaseController
{

    public function show()
    {
        $total = Category::all()->count();
        list($cats, $pages) = paginate($total, 5, new Category);
        $subTotal = SubCategory::all()->count();
        list($subcats,) = paginate($subTotal, 5, new SubCategory);

        $cats = json_decode(json_encode($cats));
        $subcats = json_decode(json_encode($subcats));
//beautify($subcats);
        view('admin/category/create', compact("cats", "pages", "subcats", "subpages"));
    }

    public function store()
    {
        $post = Request::get('post');
        if (CSRF::checkToken($post->_token)) {
            // Check Rules
            $rules = [
                "name" =>
                    [
                        "string" => true,
                        "unique" => "categories"
                    ]
            ];
            $valid = new Validator();
            $valid->checkData($post, $rules);
            if ($valid->hasErrors()) {
                $errors = $valid->getErrors();
                $cats = Category::all();
                view('admin/category/create', compact("cats", "errors"));
            } else {
                $cat = Category::create([
                    "name" => $post->name,
                    "slug" => slug($post->name)
                ]);
                if ($cat) {
                    $success = "Category Created Successfully!";
                    $cats = Category::all();
                    view('admin/category/create', compact("cats", "errors", "success"));
                }
            }
        } else {
            Session::flash("error", "Session Expired!");
        }
    }

    function delete($id)
    {
        $cat = Category::destroy($id);
        if ($cat) {
            Session::flash("delete_success", "Deleted Successfully!");
            Redirect::redirect("/admin/category/create");
        }
    }

    function update()
    {
        $post = Request::get('post');
        if (CSRF::checkToken($post->edit_token)) {
            $rules = [
                "name" =>
                    [
                        "string" => true,
                        "unique" => "categories"
                    ]
            ];
            $valid = new Validator();
            $valid->checkData($post, $rules);
            if ($valid->hasErrors()) {
                $errors = $valid->getErrors();
                echo json_encode($errors);
                exit();
            } else {
                $cat = Category::where("id", $post->edit_id)->update([
                    "name" => $post->name
                ]);
            }
        } else {
            header("HTTP/1.1 422", true, 422);
            echo "CSRF Token Miss Match Exception!";
            exit();
        }
    }
}
