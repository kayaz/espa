<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Boxes extends Model
{
    use LogsActivity, HasTranslations;

    protected static $logName = 'Boksy';
    public $translatable = ['title', 'text', 'file_alt', 'link', 'link_button'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
        'file',
        'file_alt',
        'link',
        'link_button',
        'link_target',
        'aos_animation',
        'aos_duration',
        'aos_delay',
        'aos_offset',
        'sort'
    ];


    public function getActivitylogOptions(): LogOptions
    {
        // TODO: Implement getActivitylogOptions() method.
    }
}
