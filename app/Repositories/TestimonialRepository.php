<?php namespace App\Repositories;

use App\Models\Testimonial;

class TestimonialRepository extends BaseRepository
{
    protected $model;

    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }
}
