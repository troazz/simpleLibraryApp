<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Publisher;

class PublisherController extends Controller
{
    public function index(Request $request, $id = false)
    {
        $publisher    = new Publisher();
        $active_menu = 'publisher';

        // proccess when saving publisher
        if ($request->isMethod('post')){
            $rules = [
                'name'    => 'required',
                'address' => 'required',
                'phone'   => 'required|max:20',
            ];

            $v = \Validator::make($request->all(), $rules);
            if ($v->passes()) {
                $publisher          = Publisher::firstOrNew(['id' => $request->input('id')]);
                $new                = !$publisher->exists();
                $publisher->name    = $request->input('name');
                $publisher->address = $request->input('address');
                $publisher->phone   = $request->input('phone');
                $publisher->notes   = $request->input('notes');
                $publisher->save();

                \Session::flash('flash_message', "Publisher successfully ".($new ? 'created' : 'updated').".");
                parse_str(parse_url(url()->previous(), PHP_URL_QUERY),$param);

                return redirect(route('publisher', $param));
            } else {

                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        }elseif ($id)
            $publisher = Publisher::find($id);

        // get list publishers
        $param = [];
        if ($request->input('page'))
            $param['page'] = $request->input('page');
        $q = $request->input('q');
        $publishers = Publisher::orderBy('name', 'asc');
        if ($q){
            $publishers = $publishers->where('name', 'like', "%$q%");
            $param['q'] = $q;
        }
        $publishers = $publishers->paginate(10);
        $publishers->appends($param);

        return view('publisher/index', compact('publisher', 'active_menu', 'publishers', 'request', 'param'));
    }

    function detail(Request $request, $id)
    {
        if ($request->ajax() && $id){
            $publisher = Publisher::find($id);

            return view('publisher/detail', compact('publisher'));
        }else
            abort(404);
    }

    public function delete($id)
    {
        Publisher::where('id', $id)->delete();
        \Session::flash('flash_message', "Publisher successfully deleted.");

        return redirect()->back();
    }
}
