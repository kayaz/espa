<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class OfferService
{
    public function upload(string $title, UploadedFile $file, object $model, bool $delete = false)
    {
        if ($delete) {
            if (File::isFile(public_path(config('images.offer.file_path') . $model->file_thumb))) {
                File::delete(public_path(config('images.offer.file_path') . $model->file_thumb));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('offer', $name, 'public_uploads');
        $filepath = public_path(config('images.offer.file_path') . $name);

        Image::make($filepath)
            ->fit(
                config('images.offer.width'),
                config('images.offer.height')
            )->save($filepath);

        $model->update(['file_thumb' => $name]);
    }
}
