<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Book;
use App\Category;
use App\Publisher;
use App\Writer;
use App\Keyword;

class BookController extends Controller
{
    public function form(Request $request, $id = null){
        $active_menu = 'book';
        $referer = $request->input('referer') ? $request->input('referer') : url()->previous();
        $keywords = $writers = [];
        if ($id === null)
            $id = $request->input('id');

        if ($id){
            $book = Book::where('id',$id)
                ->with(['keywords' => function($q){
                    $q->select('id', 'name');
                }, 'writers' => function ($q){
                    $q->select('id', 'name');
                }])
                ->first();
            if (!$book)
                abort(404);

            $writers = $book->writers;
            $keywords = $book->keywords;
        }else
            $book = new Book();

        if ($request->isMethod('post')){
            $rules = [
                'title'     => 'required|max:100',
                'synopsis'  => 'required|max:120',
                'category'  => 'required|numeric',
                'publisher' => 'required|numeric',
                'writer'    => 'required',
                'writer[*]' => 'numeric',
                'photo'     => 'sometimes|image|max:2048'
            ];
            $v = \Validator::make($request->all(), $rules);
            if ($v->passes()) {
                $new                = !$book->exists();
                $book->title        = $request->input('title');
                $book->synopsis     = $request->input('synopsis');
                $book->description  = $request->input('description');
                $book->publisher_id = $request->input('publisher');
                $book->category_id  = $request->input('category');

                // proccess uploaded photo
                if ($request->hasFile('photo')) {
                    $foto            = $request->file('photo');
                    $destinationPath = public_path() . '/uploads/book/';
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
                    if ($book->photo) {
                        \File::delete($destinationPath . $book->photo);
                    }
                    $book->photo = $filename;
                }
                $book->save();
                $book->writers()->sync($request->input('writer'));
                $keywords = $request->input('keyword');
                if (!is_array($keywords))
                    $keywords = [];
                foreach($keywords as $k => $v){
                    if (!is_numeric($v)){
                        $keyword = Keyword::firstOrNew(['name' => $v]);
                        $keyword->save();
                        $keywords[$k] = $keyword->id;
                    }
                }
                $book->keywords()->sync($keywords);

                \Session::flash('flash_message', "Book successfully ".($new ? 'created' : 'updated').".");

                return redirect($referer);
            }else {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }

        }
        if ($request->old('writer')){
            $writers = Writer::select('id', 'name')
                ->whereIn('id', $request->old('writer'))
                ->get()
                ->toArray();
        }
        if ($request->old('keyword')){
            $keywords = [];
            $tmp = [];
            foreach($request->old('keyword') as $k => $v){
                if (!is_numeric($v))
                    $keyword[] = ['id' => '', 'name' => $v];
                else
                    $tmp[] = $v;
            }
            if ($tmp)
                $keywords = array_merge(
                    $keywords,
                    Keyword::select('id', 'name')
                        ->whereIn('id', $tmp)
                        ->get()
                        ->toArray()
                );
        }

        $categories = Category::orderBy('name', 'asc')->lists('name', 'id');
        $publishers = Publisher::orderBy('name', 'asc')->lists('name', 'id');

        return view('book/form', compact('active_menu', 'categories', 'request', 'book', 'referer', 'publishers', 'writers', 'keywords'));
    }

    public function delete($id)
    {
        Book::where('id', $id)->delete();
        \Session::flash('flash_message', "Book successfully deleted.");

        return redirect()->back();
    }

    function detail(Request $request, $id)
    {
        if ($request->ajax() && $id){
            $book = Book::find($id);

            return view('book/detail', compact('book'));
        }else
            abort(404);
    }

    public function index(Request $request)
    {
        $active_menu = 'book';
        $param = [];
        if ($request->input('page'))
            $param['page'] = $request->input('page');
        $q = $request->input('q');
        $books = Book::orderBy('title', 'asc');
        if ($q){
            $books = $books->where('title', 'like', "%$q%");
            $param['q'] = $q;
        }
        $books = $books->paginate(10);
        $books->appends($param);

        $count = [
            'count_book' => Book::count(),
            'count_writer' => Writer::count(),
            'count_publisher' => Publisher::count(),
        ];
        $v_count = view('book/_count', $count);

        return view('book/index', compact('books', 'active_menu', 'request', 'v_count'));
    }

    public function remote(Request $request, $type)
    {
        if ($request->ajax()){
            switch ($type) {
                case 'writer':
                    $writers = Writer::where('name', 'like', '%'.$request->input('query').'%')
                            ->take(10)
                            ->get()
                            ->toArray();
                    return response()->json($writers);
                    break;
                case 'keyword':
                    $keywords = Keyword::where('name', 'like', '%'.$request->input('query').'%')
                        ->take(10)
                        ->get()
                        ->toArray();
                    return response()->json($keywords);
                    break;
            }
        }
        abort(404);
    }
}
