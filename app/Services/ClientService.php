<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ClientService
{
    public function upload(string $title, UploadedFile $file, object $model, bool $delete = false)
    {
        if ($delete) {
            if (File::isFile(public_path(config('images.client.file_path') . $model->file))) {
                File::delete(public_path(config('images.client.file_path') . $model->file));
            }
        }

        $name = date('His').'_'.Str::slug($title).'.' . $file->getClientOriginalExtension();
        $file->storeAs('clients', $name, 'public_uploads');
        $filepath = public_path(config('images.client.file_path') . $name);

        Image::make($filepath)
            ->fit(
                config('images.client.width'),
                config('images.client.height')
            )->save($filepath);

        $model->update(['file' => $name]);
    }
}
