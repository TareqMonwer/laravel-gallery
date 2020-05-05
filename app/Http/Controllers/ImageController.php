<?php

namespace App\Http\Controllers;

use App\Image;
use App\Album;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
        return view('new_album', compact('images'));
    }


    public function album()
    {
        $albums = Album::with('images')->get();
        $total_img = 0;
        foreach ($albums as $album)
        {
            $total_img += $album->images->count();
        }
        return view('albums', compact('albums', 'total_img'));
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
     * Add more image in album gallery.
     * @param Request $request
     * @return RedirectResponse
     */
    public function addMore(Request $request)
    {
        $album_id = request('album_id');
        if($request->hasFile('image'))
        {
            foreach ($request->file('image') as $image)
            {
                $path = $image->store('uploads', 'public');
                Image::create([
                    'name'=> $path,
                    'album_id'=> $album_id
                ]);
            }
        }
        return redirect()->back();
    }


    /***
     *  Show album images
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('gallery', compact('album'));
    }

    /***
    * Delete Image Inside Album
     */
    public function destroy()
    {
        $image_id = request('image_id');
        $album_id = request('album_id');
        $image = Image::findOrFail($image_id);
        $album = Album::findOrFail($album_id);

        $album_image_count = $album->images->count();
        $filename = $image->name;
        $image->delete();
        Storage::delete('public/'.$filename);


        if ($album_image_count >= 2)
        {
            return Redirect::back();
        }
        else
        {
            $album->delete();
            return redirect()->route('home');
        }
    }
}
