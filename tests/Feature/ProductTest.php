<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreProduct()
    {
        
        $user = User::create([
            'nickname' => 'test7',
            'name' => 'test',
            'nationality' => 'test',
            'lastName' => 'test',
            'email' => 'test7@gmail.com',
            'password' => Hash::make('test12345')
        ]);

        DB::table('users')->where('nickname', 'test7')->limit(1)->update(array('email_verified_at' => '2023-01-07 20:48:38.000'));

        $this->post('/login', [
            'email' => 'test7@gmail.com',
            'password' => 'test12345'
        ]);

        $this->assertAuthenticated();

        $response = $this->post('/addProduct/test', [
            'nameProduct' => 'test',
            'category' => 'Tecnology',
            'description' => 'test',
            'price' => 999,
            'state' => 'NEW',
            'quantityStock' => 100,
            'photo' => UploadedFile::fake()->image('post.png'),
        ]);

        $this->assertDatabaseHas('products', [
            'userId' => $user->id,
            'nameProduct' => 'test',
            'categoryId' => 1,
            'description' => 'test',
            'price' => 999,
            'state' => 'NEW',
            'quantityStock' => 100
        ]);

        $response->assertRedirect('/addProduct/test');
    }

   
}
