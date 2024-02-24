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

        $personnes = [];

        if ($type === 'membre') {
            $personnes = $this->membreRepositorie->paginate();
        } elseif ($type === 'client') {
            $personnes = $this->clientRepositorie->paginate();
        }

        if ($request->ajax()) {
            $searchQuery = $request->get('query');
            if (!empty($searchQuery)) {
                $searchQuery = str_replace(" ", "%", $searchQuery);
                if ($type === 'membre') {
                    $personnes = $this->membreRepositorie->searchMembre($searchQuery);
                } elseif ($type === 'client') {
                    $personnes = $this->clientRepositorie->searchClient($searchQuery);
                }
                return view('personne.index', $personnes)->render();
            }
        }

        return view('personne.index',compact('personnes','type'));
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
        if ($type === 'membre') {
            $personne = $this->membreRepositorie->create($data);
        } elseif ($type === 'client') {
            $personne = $this->clientRepositorie->create($data);
        }
        return redirect()->route($type.'.index')->with('success', $type.' a été ajoutée avec succès');
    }

    public function show(Request $request, $id)
    {
        $type = $this->getTypeFromRoute($request->route()->getName());
        if ($type === 'membre') {
            $personne = $this->membreRepositorie->find($id);
        } elseif ($type === 'client') {
            $personne = $this->clientRepositorie->find($id);
        }
        return view('personne.show', compact('personne'))->with('type', $type);
    }

    public function edit(Request $request ,$id)
    {
        $type = $this->getTypeFromRoute($request->route()->getName());
        if ($type === 'membre') {
            $personne = $this->membreRepositorie->find($id);
        } elseif ($type === 'client') {
            $personne = $this->clientRepositorie->find($id);
        }
        return view('personne.edit', compact('personne','type'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $type = $this->getTypeFromRoute($request->route()->getName());
        if ($type === 'membre') {
            $personne = $this->membreRepositorie->update($id, $data);
        } elseif ($type === 'client') {
            $personne = $this->clientRepositorie->update($id, $data);
        }
        return back()->with('success', $type.' a été modifiée avec succès');
    }

    public function delete(Request $request ,$id)
    {
        $type = $this->getTypeFromRoute($request->route()->getName());
        if ($type === 'membre') {
            $personne = $this->membreRepositorie->delete($id);
        } elseif ($type === 'client') {
            $personne = $this->clientRepositorie->delete($id);
        }
        return redirect()->route($type.'.index')->with('success', $type.' a été supprimée avec succès');
    }

    private function getTypeFromRoute($routeName)
    {
        $parts = explode('.', $routeName);
        return $parts[0];
    }
}
