<?php

namespace App\Http\Controllers\Personne;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\personne\ClientRepositorie;
use Illuminate\Support\Str;
use App\Models\Membre;
use App\Models\Client;
use Illuminate\Support\Facades\Route;



class PersonneController extends Controller
{
    // protected $membreRepositorie;
    // protected $clientRepositorie;

   
    public function index(Request $request)
    {
        
        $personnes = $this->getRepositorie()->paginate();
        $type = $this->getType();
        if ($request->ajax()) {
            $searchQuery = $request->get('query');
            if (!empty($searchQuery)) {
                $searchQuery = str_replace(" ", "%", $searchQuery);
                $methodName = 'search' . ucfirst($type);
                $personnes = $this->{$type . 'Repositorie'}->{$methodName}($searchQuery);
                
                return view('personne.index', compact('personnes', 'type'))->render();
            }
        }

        return view('personne.index', compact('personnes', 'type'));
    }


    public function create()
    {
        $type = $this->getType();
        return view('personne.create',compact('type'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $type = $this->getType();
        $personne =  $this->getRepositorie()->create($data);
        return redirect()->route($type.'.index')->with('success', $type.' a été ajoutée avec succès');
    }

    public function show($id)
    {
        $type = $this->getType();
        $personne = $this->getRepositorie()->find($id);
        return view('personne.show', compact('personne'))->with('type', $type);
    }

    public function edit($id)
    {
        $type = $this->getType();
        $personne = $this->getRepositorie()->find($id);
        return view('personne.edit', compact('personne','type'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $type = $this->getType();
        $personne = $this->getRepositorie()->update($id, $data);
        return back()->with('success', $type.' a été modifiée avec succès');
    }

    public function delete(Request $request ,$id)
    {
        $type = $this->getType();
        $personne = $this->getRepositorie()->delete($id);
        return redirect()->route($type.'.index')->with('success', $type.' a été supprimée avec succès');
    }

    private function getTypeFromRoute($routeName)
    {
        $parts = explode('.', $routeName);
        return $parts[0];
    }

    private function getRepositorie(){
        $route = Route::getCurrentRoute()->getName();
        $type = explode('.',$route);
        $model = str::ucfirst($type[0]);
        $modelRepository = $model.'Repositorie';
        $path = "\\App\\Repositories\\personne\\".$modelRepository;

        if($model === 'Membre'){
            $repository = new $path(new Membre);
        }elseif($model === 'Client'){
            $repository = new $path(new Client);
        }
        return $repository;
    }

    private function getType(){
        $route = Route::getCurrentRoute()->getName();
        $type = explode('.',$route);
        return $type[0];
    }
}
