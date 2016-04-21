<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;

class CategoryController extends Controller
{
    public function index(Request $request, $id = false)
    {
        $category    = new Category();
        $active_menu = 'category';
        if ($request->isMethod('post')){
            $rules = [
                'name'     => 'required',
            ];

            $v = \Validator::make($request->all(), $rules);
            if ($v->passes()) {
                $category       = Category::firstOrNew(['id' => $request->input('id')]);
                $new            = !$category->exists();
                $category->name = $request->input('name');
                $category->save();
                \Session::flash('flash_message', "Category successfully ".($new ? 'created' : 'updated').".");

                return redirect('user');
            } else {

                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        }elseif ($id)
            $category = Category::find($id);
        $categories = Category::paginate(20);

        return view('category/index', compact('category', 'active_menu', 'categories'));
    }
}
