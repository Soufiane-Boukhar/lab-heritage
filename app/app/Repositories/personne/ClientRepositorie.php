<?php

namespace App\Repositories\personne;

use App\Repositories\BaseRepositorie;
use App\Models\Client;

class ClientRepositorie extends BaseRepositorie
{
    public function __construct(Client $client){
        parent::__construct($client);
    }

    public function paginate($perPage = 3, $type = 'Client'){
        return parent::paginate($perPage, $type);
    }
    
    public function searchClient($search){
        return Client::where('type', 'Client')->where(function($query) use ($search) {
            $query->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('prenom', 'like', '%' . $search . '%');
        })->paginate();
    }
}