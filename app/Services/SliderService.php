<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

//CMS
use App\Models\Slider;

class SliderService
{
    public function upload(string $title, UploadedFile $file, object $model, bool $delete = false)
    {

        if ($delete) {
            if (File::isFile(public_path(config('images.slider.file_path') . $model->file))) {
                File::delete(public_path(config('images.slider.file_path') . $model->file));
            }
            if (File::isFile(public_path(config('images.slider.thumb_file_path') . $model->file))) {
                File::delete(public_path(config('images.slider.thumb_file_path') . $model->file));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('slider', $name, 'public_uploads');

        $filepath = public_path(config('images.slider.file_path') . $name);
        $thumb_filepath = public_path(config('images.slider.thumb_file_path') . $name);

        Image::make($filepath)
            ->fit(
                config('images.slider.big_width'),
                config('images.slider.big_height')
            )->save($filepath);

        Image::make($filepath)
            ->fit(
                config('images.slider.thumb_width'),
                config('images.slider.thumb_height')
            )->save($thumb_filepath);

        $model->update(['file' => $name]);
    }
}
