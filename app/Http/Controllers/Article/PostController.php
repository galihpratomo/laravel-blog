<?php

namespace App\Http\Controllers\Article;

use App\Article\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use DB;
use View;
use Session;
use DataTables;
use Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $data['title']              = 'Data post';
        return view('article.post.index')->with($data);
    }

    public function json()
	{
        $model = Post::select([
                        'posts.id',
                        'posts.title',
                        'posts.content',
                        'posts.category',
                    ]);

                    if (request('status') != "All") {
                        $model->where('status', request('status'));
                    }
        return DataTables::of($model->get())
                ->editColumn('aksi', function ($item) {
                        $aksi   = ' <button data-toggle="tooltip" title="Trash" class="btn btn-circle btn-danger btn-sm delete" id="'.$item->id.'"  title="Delete" ><i class="fa fa-trash-o"></i></button>
                                    <button data-toggle="tooltip" title="Edit" class="btn btn-circle btn-warning btn-sm edit" id="'.$item->id.'"><i class="fa fa-pencil-square-o"></i></button>
                                ';

                        return $aksi;
                    })
                ->rawColumns(['aksi'])
                ->make(true);
	}


    public function create(Request $request)
    {
        if ($request->ajax()) {
            $view   = View::make('article.post.create')->render();
            return response()->json(['html' => $view]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function store(Request $req)
    {
        if ($req->ajax()) {
            $rules = [
                'title'         => 'required|min:20',
                'content'       => 'required|min:200',
                'category'      => 'required|min:3',
                'status'        => 'required|in:Publish,Draft'
            ];

            $validator = Validator::make($req->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'type'      => 'error',
                    'errors'    => $validator->getMessageBag()->toArray()
                ]);
            } else {
                try {
                    Post::create([
                        'title'             => $req->title,
                        'content'           => $req->content,
                        'category'          => $req->category,
                        'status'            => $req->status
                    ]);
                   
                    return response()->json(['type' => 'success', 'message' => "<div class='alert alert-success'>Successfully Created</div>"]);
                } catch (\Throwable $th) {
                    Session::flash('server_error', $th->getMessage());
                    return response()->json(['type' => 'error', 'message' => "Failed"]);
                }
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function edit($id, Request $request)
    {
        if ($request->ajax()) {
            $data          = Post::where('id', $id)->first();
            $view          = View::make('article.post.edit', compact('data'))->render();
            return response()->json(['html' => $view]);
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function update(Request $req, $id)
    {
        if ($req->ajax()) {
            $rules = [
                'title'         => 'required|min:20',
                'content'       => 'required|min:200',
                'category'      => 'required|min:3',
                'status'        => 'required|in:Publish,Draft'
            ];

            $validator = Validator::make($req->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'type'    => 'error',
                    'message' => "Validator",
                    'errors'  => $validator->getMessageBag()->toArray()
                ]);
            } else {
                Post::where('id', $id)
                                ->update([
                                    'title'             => $req->title,
                                    'content'           => $req->content,
                                    'category'          => $req->category,
                                    'status'            => $req->status
                                ]);
                return response()->json(['type' => 'success', 'message' => "<div class='alert alert-success'>Successfully Edit</div>"]);
            }
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    }

    public function destroy($id, Request $req)
    {
        if ($req->ajax()) {
            try {
                $cek = Post::where('id', $id)->first();

                if($cek){
                    Post::where('id', $id)
                                ->update([
                                    'status'        => 'Thrash',
                                ]);
                    
                    return response()->json(['type' => 'success', 'message' => "<div class='alert alert-success'>Successfully Deleted</div>"]);
                }else{
                    return response()->json(['type' => 'success', 'message' => "<div class='alert alert-warning'>Gagal, ID tidak ad</div>"]);
                }
            } catch (\Throwable $th) {
                Session::flash('server_error', $th->getMessage());
                return response()->json(['type' => 'error', 'message' => "<div class='alert alert-danger'>Failed Deleted</div>"]);
            } 
        } else {
            return response()->json(['status' => 'false', 'message' => "Access only ajax request"]);
        }
    } 


}