<?php

namespace App\Repositories\personne;

use App\Repositories\BaseRepositorie;
use App\Models\Membre;

class MembreRepositorie extends BaseRepositorie
{
    public function __construct(Membre $membre){
        parent::__construct($membre);
    }

    public function paginate($perPage = 3, $type = 'Membre'){
        return parent::paginate($perPage, $type);
    }
    

    public function searchMembre($search){
        return Membre::where('type', 'Membre')->where(function($query) use ($search) {
            $query->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('prenom', 'like', '%' . $search . '%');
        })->paginate();
    }
}
