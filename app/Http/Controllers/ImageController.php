<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Album;
use Illuminate\Validation\ValidationException;

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
}
