<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use PharIo\Manifest\Author;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     use HasFactory,Sortable;

    protected $fillable = [
        'title', 'body', 'image', 'author_id', 'category_id', 'date'
    ];

    public $sortable = ['created_at', 'updated_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
   // protected $touches = ['category', 'tags'];

    /**
     * Get the category that the article belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the tags associated with the given article.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'article_tag','article_id');
    }

    /**
     * Get the author associated with the given article.
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
