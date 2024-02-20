<?php

namespace App\Repositories;

use App\Repositories\BaseRepositorie;
use App\Models\Membre;

class MembreRepositorie extends BaseRepositorie
{
    public function __construct(Membre $post){
        parent::__construct($post);
    }

    public function searchMembre($search){
        return Membre::where('nom', 'like', '%' . $search . '%')->orWhere('prenom', 'like', '%' . $search . '%')->paginate();
    }
}