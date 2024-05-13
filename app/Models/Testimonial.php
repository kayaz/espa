<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use LogsActivity, HasTranslations;

    protected static $logName = 'Referencje';
    public array $translatable = ['text', 'author_jobposition'];

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

    public function getActivitylogOptions(): LogOptions
    {
        // TODO: Implement getActivitylogOptions() method.
    }
}
