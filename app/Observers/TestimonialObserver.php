<?php

namespace App\Observers;

use Illuminate\Support\Facades\File;

// CMS
use App\Models\Testimonial;

class TestimonialObserver
{
    /**
     * Handle the box "deleted" event.
     *
     * @param Testimonial $model
     * @return void
     */
    public function deleted(Testimonial $model)
    {
        $file = public_path(config('images.testimonial.file_path') . $model->file);

        if (File::isFile($file)) {
            File::delete($file);
        }
    }
}
