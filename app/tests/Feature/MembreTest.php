<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\MembreRepositorie;
use App\Models\Membre;

class MembreTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {
        $response = new MembreRepositorie(new Membre);
        $response->paginate();
        $this->assertNotNull($response);
    }

    public function test_store(): void{
        $response = new MembreRepositorie(new Membre);
        $now = \Carbon\Carbon::now();
        $input = [
            'nom' => 'Ahlam',
            'prenom' => 'Saidi',
            'email' => 'ahlam@gmail.com',
            'created_at' => $now,
            'updated_at' => $now,
        ];
        $response->create($input);
        $this->assertDatabaseHas('personnes', $input);
    }


    public function test_edit(): void{
        $response = new MembreRepositorie(new Membre);
        $response->find(1);
        $this->assertNotNull($response);
    }

    public function test_update(): void{
        $response = new MembreRepositorie(new Membre);
        $now = \Carbon\Carbon::now();
        $input = [
            'nom' => 'Ahlam',
            'prenom' => 'Saidi',
            'email' => 'ahlam@gmail.com',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $membre = Membre::create($input);

        $response->find($membre->id);
        
        $inputUpdate = [
            'email' => 'ahlam2024@gmail.com' 
        ];
        $response->update($membre->id,$inputUpdate);
        $this->assertDatabaseHas('personnes', $inputUpdate);
    }

    public function test_show(): void{
        $response = new MembreRepositorie(new Membre);
        $response->find(1);
        $this->assertNotNull($response);
    }

    public function test_delete(): void{
        $response = new MembreRepositorie(new Membre);
        $now = \Carbon\Carbon::now();
        $input = [
            'nom' => 'Ahlam',
            'prenom' => 'Saidi',
            'email' => 'ahlam@gmail.com',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $membre = Membre::create($input);
        $response->find($membre->id);
        $this->assertNotNull($response);
        $response->delete($membre->id);
        $this->assertDatabaseMissing('personnes', $input);
    }

    public function test_search(): void{
        $response = new MembreRepositorie(new Membre);
        $input = 'a';
        $response->searchMembre($input);
        $this->assertNotNull($response);
    }
}
