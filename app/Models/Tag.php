<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name'];
    protected $table = 'tags';
    public function articles()
    {
       return $this->belongsToMany(Article::class,'article_tag','tag_id');
    }
}
