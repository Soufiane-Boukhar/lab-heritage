<?php

namespace App\Http\Controllers\Personne;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\personne\MembreRepositorie;
use App\Repositories\personne\ClientRepositorie;

class PersonneController extends Controller
{
    protected $membreRepositorie;
    protected $clientRepositorie;

    public function __construct(MembreRepositorie $membreRepositorie, ClientRepositorie $clientRepositorie)
    {
        $this->membreRepositorie = $membreRepositorie;
        $this->clientRepositorie = $clientRepositorie;
    }

    public function index(Request $request)
    {
        $type = $this->getTypeFromRoute($request->route()->getName());
        $repository = $type . 'Repositorie';
        $personnes = $this->{$repository}->paginate();
        
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


    public function create(Request $request)
    {
        $type = $this->getTypeFromRoute($request->route()->getName());
        return view('personne.create',compact('type'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $type = $this->getTypeFromRoute($request->route()->getName());
        $repository = $type . 'Repositorie';
        $personne = $this->{$repository}->create($data);
        return redirect()->route($type.'.index')->with('success', $type.' a été ajoutée avec succès');
    }

    public function show(Request $request, $id)
    {
        $type = $this->getTypeFromRoute($request->route()->getName());
        $repository = $type . 'Repositorie';
        $personne = $this->{$repository}->find($id);
        return view('personne.show', compact('personne'))->with('type', $type);
    }

    public function edit(Request $request ,$id)
    {
        $type = $this->getTypeFromRoute($request->route()->getName());
        $repository = $type . 'Repositorie';
        $personne = $this->{$repository}->find($id);
        return view('personne.edit', compact('personne','type'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $type = $this->getTypeFromRoute($request->route()->getName());
        $repository = $type . 'Repositorie';
        $personne = $this->{$repository}->update($id, $data);
        return back()->with('success', $type.' a été modifiée avec succès');
    }

    public function delete(Request $request ,$id)
    {
        $type = $this->getTypeFromRoute($request->route()->getName());
        $repository = $type . 'Repositorie';
        $personne = $this->{$repository}->delete($id);
        return redirect()->route($type.'.index')->with('success', $type.' a été supprimée avec succès');
    }

    private function getTypeFromRoute($routeName)
    {
        $parts = explode('.', $routeName);
        return $parts[0];
    }
}
