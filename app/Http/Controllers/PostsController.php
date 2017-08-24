<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Posts_img_upload;
use App\Posts_likes;
use Auth;
use DB;
use Illuminate\Filesystem\Filesystem;
use Carbon\Carbon;
use File;

class PostsController extends Controller
{
    
    public function index()
    {
        $posts = Post::paginate(10);

        return view('posts.index', compact('posts'));
    }
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store(Request $request)
    {
        if($request['data_text'] || $request['data_img'] != '[]' || $request['data_vid'] != '[]') {
            $aImgs = json_decode($request['data_img']);
            $aVids = json_decode($request['data_vid']);
            
            // Create the objects from the Post and File Models
            $postFile = new Posts_img_upload();
            $post = new Post();
            
            /* Create the directory (if doesn't exist) for the users posts files 
            * and paste de files inside it
            */
            $path = public_path() . $postFile->getDefaultPath();
            
            $directory = new Filesystem();
            if(!$directory->exists($path)) {
                $directory->makeDirectory($path, 0755, true, true);
            }
            
            $post->setUserIdAttribute(Auth::user()->id);
            $post->setContentAttribute($request['data_text']);
            $post->setCreatedAtAttribute(Carbon::now());
            $post->setUpdatedAtAttribute(Carbon::now());
            
            // Insert the data in the posts table
            DB::table('posts')->insert(['user_id' => $post->getUserIdAttribute(), 'content' => $post->getContentAttribute(),
                                        'created_at' => $post->getCreatedAtAttribute(), 'updated_at' => $post->getUpdatedAtAttribute()]);
            
            // get the last record inserted in the posts table
            $lastRecord = DB::table('posts')->select('id')
                                            ->where('created_at', $post->getCreatedAtAttribute()->format('Y-m-d H:i:s'))
                                            ->orderBy('id', 'desc')
                                            ->first();
            
            /*
             * Convert the base64 decoded images and paste them in the directory
             */
            foreach($aImgs as $img) {
                $dataImage = $img;
                $dataImage = str_replace('data:image/jpeg;base64,', '', $dataImage);
                $dataImage = str_replace('data:image/png;base64,', '', $dataImage);
                $dataImage = str_replace('data:image/gif;base64,', '', $dataImage);
                $dataImage = str_replace('data:image/webp;base64,', '', $dataImage);
                $dataImage = str_replace('data:image/ico;base64,', '', $dataImage);
                $dataImage = str_replace('data:image/bmp;base64,', '', $dataImage);
                $dataImage = str_replace('data:image/tif;base64,', '', $dataImage);
                $dataImage = str_replace('data:image/tga;base64,', '', $dataImage);
                $dataImage = str_replace(' ', '+', $dataImage);
                $fileName = uniqid() . '.jpg';
                $filePath = $path . $fileName;
                $dataImage = base64_decode($dataImage);
                file_put_contents($filePath, $dataImage);
                
                $postFile->setPostIdAttribute($lastRecord->id);
                $postFile->setPathAttribute($postFile->getDefaultPath() . $fileName);
                
                DB::table('posts_img_uploads')->insert(['post_id' => $postFile->getPostIdAttribute(), 'path' => $postFile->getPathAttribute()]);
            }
        }
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|string|max:255',
        ]);
        
        /* 
         * Update data in the database will happen only if all the content field is filled
         * The image field in this case isn't required
         */
        if($request->content) {
            // Searches the post in the database
            $post = Post::findOrFail($id);
            
            /*
             * If the img upload fiels is set, the image will be uploaded
             * And the table posts_img_uploads will be updated
             */
            if($request->file('img_upload')) {
                /* Create the directory (if doesn't exist) for the users images posts 
                * and paste de files inside it
                */
                $path = public_path() . '\files\users\\' . Auth::user()->username . '\posts_uploads\\';

                $directory = new Filesystem();
                if(!$directory->exists($path)) {
                    $directory->makeDirectory($path, 0755, true, true);
                }

                $fileName = $request->file('img_upload')->hashName();
                $filePath = $path. '\\' . $fileName;

                File::move($request->file('img_upload'), $filePath);
                
                $post_img = 'files\users\\' . Auth::user()->username . '\posts_uploads\\' . $fileName;
                
                DB::table('posts_img_uploads')->where('post_id', $post->id)
                                              ->update(['path' => $post_img]);
            }
            
            /*
             * Update the post info into the posts table
             */
            
            $post->update($request->all());
        }
        
        return redirect('/posts');
    }

    public function destroy($id)
    {
        //$post = Post::findOrFail($id);
        //$post->delete();
        //$post->forceDelete(); // forces the delete action even whern the table has the column 'deleted_at'
        Post::destroy($id);

        return redirect('/posts');
    }

    public function restore($id) 
    {
        $post = Post::findOrFail($id);
        $post->restore();
    }
    
    public function storeLike(Request $request) 
    {
        /*
         * Verifies if the Post is liked by the user
         * If it isns't, the like will be added
         * If it is, the like will be deleted
        */
        
        $post = new Post();
        
        $is_liked = $post->getIfPostIsLiked($request['post_id'], $request['user_id']);
        
        if($is_liked) {
            $post_like = new Posts_likes();
            $post_like->post_id = $request['post_id'];
            $post_like->user_id = $request['user_id'];
            
            DB::table('posts_likes')->where('post_id', $post_like->post_id)
                                    ->where('user_id', $post_like->user_id)
                                    ->delete();
        } else {
            $post_like = new Posts_likes();
            $post_like->post_id = $request['post_id'];
            $post_like->user_id = $request['user_id'];

            DB::table('posts_likes')->insert(['post_id' => $post_like->post_id, 'user_id' => $post_like->user_id]);
        }
    }
    
    public function uploadTempFile(Request $request)
    {
        /* Create the temporary directory (if doesn't exist) for the users posts files 
            * and paste de files inside it
            */
        $path = '/files/temp_upload_files/Users/' . Auth::user()->username . '/posts_uploads/';

        $directory = new Filesystem();
        
        if(!$directory->exists($path)) {
            $directory->makeDirectory($path, 0755, true, true);
        }
        
        /*
         *  Convert the base64 decoded image and paste it in the directory
         */
        $dataImage = $request['data_file']; 
        $dataImage = str_replace('data:image/jpeg;base64,', '', $dataImage); 
        $dataImage = str_replace(' ', '+', $dataImage); 
        $fileName = uniqid() . '.jpg';
        $filePath = $path . $fileName;
        $dataImage = base64_decode($dataImage);
        file_put_contents(public_path() . $filePath, $dataImage);
        
        return url('/') . $filePath;
    }
    
    public function deleteTempFile(Request $request) 
    {
        if(unlink(public_path() . '/files/temp_upload_files/Users/' . Auth::user()->username . '/posts_uploads/' . $request['file_name'])) {
            return 'success';
        } else {
            return '';
        }
    }
    
}
