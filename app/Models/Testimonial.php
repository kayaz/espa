<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use LogsActivity, HasTranslations;

    protected static $logName = 'Referencje';
    public $translatable = ['text', 'author_jobposition'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'file',
        'file_url',
        'text',
        'author',
        'author_jobposition',
        'sort'
    ];
}
