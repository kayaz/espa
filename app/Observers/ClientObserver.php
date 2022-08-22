<?php

namespace App\Observers;

use Illuminate\Support\Facades\File;

// CMS
use App\Models\Client;

class ClientObserver
{
    /**
     * Handle the client "deleted" event.
     *
     * @param Client $client
     * @return void
     */
    public function deleted(Client $client)
    {
        $file = public_path(config('images.client.file_path') . $client->file);

        if (File::isFile($file)) {
            File::delete($file);
        }
    }
}
