<?php

namespace App\Http\Controllers\Membre;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Repositories\MembreRepositorie;

class MembreController extends Controller
{
    protected $MembreRepositorie;

    public function __construct(MembreRepositorie $MembreRepositorie){
        $this->MembreRepositorie = $MembreRepositorie;
    }

    public function index(){
       $membres = $this->MembreRepositorie->paginate();
       if($request->ajax()){
            $searchMembre = $request->get('query');
            if(!empty($searchMembre)){
                $searchMembre = str_replace(" ", "%", $searchMembre);
                $membres = $this->MembreRepositorie->searchMembre($searchMembre);
                return view('membre.index', compact('membres'))->render();
            }
        }
        return view('membre.index',compact('membres'));
    }

    public function store(Request $request){
        $data = $request->all();
        $membre = $this->MembreRepositorie->create($data);
        return view('membre.index')->with('success','Membre a été ajouté avec sucess');
    }

    public function show($id){
        $membre = $this->MembreRepositorie->find($id);
        return view('membre.show',compact('membre'));
    }

    public function edit($id){
        $membre = $this->MembreRepositorie->find($id);
        return view('membre.edit',compact('membre'));
    }

    public function update($id){
        $data = $request->all();
        $membre = $this->MembreRepositorie->update($id, $data);
        return back()->with('success','Membre a été modifié avec sucess');
    }

    public function delete($id){
        $membre = $this->MembreRepositorie->delete($id);
        return view('membre.index')->with('success','Membre a été supprimé avec sucess');
    }
}