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

        // proccess when saving category
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
                parse_str(parse_url(url()->previous(), PHP_URL_QUERY),$param);
                return redirect(route('category', $param));
            } else {

                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        }elseif ($id)
            $category = Category::find($id);

        // get list categories
        $param = [];
        if ($request->input('page'))
            $param['page'] = $request->input('page');
        $q = $request->input('q');
        $categories = Category::orderBy('name', 'asc');
        if ($q){
            $categories = $categories->where('name', 'like', "%$q%");
            $param['q'] = $q;
        }
        $categories = $categories->paginate(10);
        $categories->appends($param);

        return view('category/index', compact('category', 'active_menu', 'categories', 'request', 'param'));
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
        \Session::flash('flash_message', "Category successfully deleted.");

        return redirect()->back();
    }
}
