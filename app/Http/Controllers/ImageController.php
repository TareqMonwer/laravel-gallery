<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Image;
use App\Album;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ImageController extends Controller
{
    /**
     * Homepage.
     */
    public function index()
    {
        $images = Image::get();
        return view('home', compact('images'));
    }


    public function album()
    {
        $albums = Album::with('images')->get();
        return view('welcome', compact('albums'));
    }

    /**
     * Store.
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function store(Request $request)
    {

        // Form Data Validation
        $this->validate($request,[
            'album'=>'required|min:3|max:50',
            'image'=>'required'
        ]);

        $album = Album::create(['name'=>$request->get('album')]);
        if($request->hasFile('image'))
        {
            foreach ($request->file('image') as $image)
            {
                $path = $image->store('uploads', 'public');
                Image::create([
                    'name'=> $path,
                    'album_id'=> $album->id
                ]);
            }
        }
        return "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                        <strong id=\"msg\">Album Created Successfully.</strong>
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>";
    }


    /***
     *  Show album images
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id){
        $album = Album::findOrFail($id);
        return view('gallery', compact('album'));
    }
}
