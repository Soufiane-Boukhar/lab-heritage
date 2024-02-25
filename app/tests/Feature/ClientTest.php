<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\personne\ClientRepositorie;
use App\Models\Client;

class ClientTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {
        $response = new ClientRepositorie(new Client);
        $response->paginate();
        $this->assertNotNull($response);
    }

    public function test_store(): void{
        $response = new ClientRepositorie(new Client);
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
        $response = new ClientRepositorie(new Client);
        $response->find(1);
        $this->assertNotNull($response);
    }

    public function test_update(): void{
        $response = new ClientRepositorie(new Client);
        $now = \Carbon\Carbon::now();
        $input = [
            'nom' => 'Ahlam',
            'prenom' => 'Saidi',
            'email' => 'ahlam@gmail.com',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $Client = Client::create($input);

        $response->find($Client->id);
        
        $inputUpdate = [
            'email' => 'ahlam2024@gmail.com' 
        ];
        $response->update($Client->id,$inputUpdate);
        $this->assertDatabaseHas('personnes', $inputUpdate);
    }

    public function test_show(): void{
        $response = new ClientRepositorie(new Client);
        $response->find(1);
        $this->assertNotNull($response);
    }

    public function test_delete(): void{
        $response = new ClientRepositorie(new Client);
        $now = \Carbon\Carbon::now();
        $input = [
            'nom' => 'Ahlam',
            'prenom' => 'Saidi',
            'email' => 'ahlam@gmail.com',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $Client = Client::create($input);
        $response->find($Client->id);
        $this->assertNotNull($response);
        $response->delete($Client->id);
        $this->assertDatabaseMissing('personnes', $input);
    }

    public function test_search(): void{
        $response = new ClientRepositorie(new Client);
        $input = 'a';
        $response->searchClient($input);
        $this->assertNotNull($response);
    }
}
