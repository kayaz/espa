<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{

    use HasTranslations;
    public $translatable = ['title', 'content', 'content_entry', 'meta_title', 'meta_description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'content_entry',
        'content',
        'meta_title',
        'meta_description',
        'meta_robots',
        'file_thumb',
        'file_pageheader',
    ];
}
