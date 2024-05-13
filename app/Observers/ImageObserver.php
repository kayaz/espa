<?php

namespace App\Observers;

use Illuminate\Support\Facades\File;

// CMS
use App\Models\Image;

class ImageObserver
{
    /**
     * Handle the image "deleted" event.
     *
     * @param  Image $image
     * @return void
     */
    public function deleted(Image $image)
    {
        if ($image->file) {
            $image_path = public_path(config('images.gallery.file_path') . $image->file);
            $image_thumb_path = public_path(config('images.gallery.thumb_file_path') . $image->file);
            $image_thumb_path_2 = public_path(config('images.gallery.thumb_file_path_2') . $image->file);

            $webp_path = public_path(config('images.gallery.webp_file_path') . $image->file_webp);
            $webp_thumb_path = public_path(config('images.gallery.thumb_webp_file_path') . $image->file_webp);

            if (File::isFile($image_path)) {
                File::delete($image_path);
            }

            if (File::isFile($image_thumb_path)) {
                File::delete($image_thumb_path);
            }

            if (File::isFile($image_thumb_path_2)) {
                File::delete($image_thumb_path_2);
            }

            if (File::isFile($webp_path)) {
                File::delete($webp_path);
            }
            if (File::isFile($webp_thumb_path)) {
                File::delete($webp_thumb_path);
            }
        }
    }
}
