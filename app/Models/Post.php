<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name','slug','image'];
    public function getRouteKeyName() {
        return 'slug';
    }
}
