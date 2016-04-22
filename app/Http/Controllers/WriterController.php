<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Writer;

class WriterController extends Controller
{
    public function index(Request $request, $id = false)
    {
        $writer    = new Writer();
        $active_menu = 'writer';

        // proccess when saving writer
        if ($request->isMethod('post')){
            $rules = [
                'name'    => 'required',
                'address' => 'required',
                'phone'   => 'required|max:20',
                'photo'   => 'sometimes|image|max:2048'
            ];

            $v = \Validator::make($request->all(), $rules);
            if ($v->passes()) {
                $writer          = Writer::firstOrNew(['id' => $request->input('id')]);
                $new             = !$writer->exists();
                $writer->name    = $request->input('name');
                $writer->address = $request->input('address');
                $writer->phone   = $request->input('phone');
                $writer->notes   = $request->input('notes');

                // proccess uploaded photo
                if ($request->hasFile('photo')) {
                    $foto            = $request->file('photo');
                    $destinationPath = public_path() . '/uploads/photo/';
                    if (!is_dir($destinationPath)){
                        if (!\File::makeDirectory($destinationPath, 0775, true)){
                            $v->add('photo', 'Couldn\'t upload file because writing file in upload directory was denied. Please contact your Administrator.');
                            return redirect()->back()->withErrors($v->errors())->withInput();
                        }
                    }
                    $filename = $foto->getClientOriginalName();

                    // change filename if exist
                    $i = 0;
                    while (is_file($destinationPath.$filename)){
                        $i++;
                        $tmp      = explode('.', $foto->getClientOriginalName());
                        $tmp[count($tmp) - 2] .= '-'.str_pad($i, 3, "0", STR_PAD_LEFT);
                        $filename = implode('.',$tmp);
                    }

                    // move uploaded photo
                    try {
                        $foto->move($destinationPath, $filename);
                    } catch (FileException $e) {
                        $v->add('photo', 'Couldn\'t upload file because writing file in upload directory was denied. Please contact your Administrator.');
                        return redirect()->back()->withErrors($v->errors())->withInput();
                    }
                    if ($writer->photo) {
                        \File::delete($destinationPath . $writer->photo);
                    }
                    $writer->photo = $filename;
                }

                $writer->save();

                \Session::flash('flash_message', "Writer successfully ".($new ? 'created' : 'updated').".");
                parse_str(parse_url(url()->previous(), PHP_URL_QUERY),$param);

                return redirect(route('writer', $param));
            } else {

                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        }elseif ($id)
            $writer = Writer::find($id);

        // get list writers
        $param = [];
        if ($request->input('page'))
            $param['page'] = $request->input('page');
        $q = $request->input('q');
        $writers = Writer::orderBy('name', 'asc');
        if ($q){
            $writers = $writers->where('name', 'like', "%$q%");
            $param['q'] = $q;
        }
        $writers = $writers->paginate(10);
        $writers->appends($param);

        return view('writer/index', compact('writer', 'active_menu', 'writers', 'request', 'param'));
    }

    function detail(Request $request, $id)
    {
        if ($request->ajax() && $id){
            $writer = Writer::find($id);

            return view('writer/detail', compact('writer'));
        }else
            abort(404);
    }

    public function delete($id)
    {
        Writer::where('id', $id)->delete();
        \Session::flash('flash_message', "Writer successfully deleted.");

        return redirect()->back();
    }
}
