<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Album extends Model
{
    protected $fillable = ['name'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
