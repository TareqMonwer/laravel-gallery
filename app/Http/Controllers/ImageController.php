<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Album;

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
     */
    public function store(Request $request)
    {
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
    }
}
