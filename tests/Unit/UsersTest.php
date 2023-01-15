<?php

namespace Tests\Unit;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testClassConstructor()
    {
        $user = new User();
        $user->nickname = "john123";
        $user->name = "John";
        $user->nationality = "Portuguese";
        $user->lastName = "Peter";
        $user->email = "john@gmail.com";
        $user->password = 'olaolaola';
        $user->save();
        $this->assertSame("john123", $user->nickname);
        $this->assertSame("John", $user->name);
        $this->assertSame("Portuguese", $user->nationality);
        $this->assertSame("Peter", $user->lastName);
        $this->assertSame("john@gmail.com", $user->email);
        $this->assertSame("olaolaola", $user->password);
    }

    public function testStoreUser()
    {
        
        $response = $this->post('/register', [
            'nickname' => 'John',
            'name' => 'bones',
            'lastName' => 'Jones',
            'nationality' => 'Portuguese',
            'email' => 'john@gmail.com',
            'password' => 'olaolaola',
            'password_confirmation' => 'olaolaola'
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/email/verify');
    }

    public function testLoginUserSuccess()
    {
        User::create([
            'nickname' => 'test',
            'name' => 'test',
            'nationality' => 'test',
            'lastName' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test')
        ]);

        $response = $this->post('/login', [
            'email' => 'test@gmail.com',
            'password' => 'test'
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/');
    }

    public function testLoginUserFailed()
    {
        User::create([
            'nickname' => 'test',
            'name' => 'test',
            'nationality' => 'test',
            'lastName' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test12345')
        ]);

        $response = $this->post('/login', [
            'email' => 'test@gmail.com',
            'password' => 'error'
        ]);
        $this->assertGuest();
        $response->assertRedirect('/');
    }

   
}
