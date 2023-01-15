<?php

namespace Tests\Feature;

use App\Models\Residence;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ResidencesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testResidences()
    {
        $user = User::create([
            'nickname' => 'testResidences',
            'name' => 'test',
            'nationality' => 'test',
            'lastName' => 'test',
            'email' => 'testResidences@gmail.com',
            'password' => Hash::make('test12345')
        ]);

        DB::table('users')->where('nickname', 'testResidences')->limit(1)->update(array('email_verified_at' => '2023-01-07 20:48:38.000'));
      
        $this->post('/login', [
            'email' => 'testResidences@gmail.com',
            'password' => 'test12345'
        ]);

        $this->assertAuthenticated();
       
        $this->post('/myResidences/test', [
            'userId' => $user->id,
            'address' => 'rua penafiel',
            'city' => 'penafiel',
            'postalCode' => '3232-222',
            'country' => 'Portugal'
        ]);

        $this->assertDatabaseHas('residences', [
            'userId' => $user->id,
            'address' => 'rua penafiel',
            'city' => 'penafiel',
            'postalCode' => '3232-222',
            'country' => 'Portugal'
        ]);
      
    }
}
