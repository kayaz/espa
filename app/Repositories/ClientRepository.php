<?php namespace App\Repositories;

use App\Models\Client;

class ClientRepository extends BaseRepository
{
    protected $model;

    public function __construct(Client $model)
    {
        parent::__construct($model);
    }
}
