<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
	protected $fillable = [
	    'name','slug',
	];

    // Tags has many blogs
    public function blogs()
    {
        return $this->hasMany('App\Models\Blog');
    }	
}
