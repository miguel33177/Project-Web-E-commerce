<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\Unit\UsersTest;

use Tests\TestCase;


class ScreenRenderedTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testGetRegisterPage()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
    public function testGetLoginPage()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testGetAboutUsPage()
    {
        $response = $this->get('/aboutUs');
        $response->assertStatus(200);
    }
    public function testGetSearchPage()
    {
        $response = $this->get('/search');
        $response->assertStatus(200);
    }

    public function payment()
    {
        $response = $this->get('/payment');
        $response->assertStatus(200);
    }

    public function testGetMyAccount()
    {
        User::create([
            'nickname' => 'test',
            'name' => 'test',
            'nationality' => 'test',
            'lastName' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test')
        ]);

        DB::table('users')->where('nickname', 'test')->limit(1)->update(array('email_verified_at' => '2023-01-07 20:48:38.000'));

        $this->post('/login', [
            'email' => 'test@gmail.com',
            'password' => 'test'
        ]);

        $this->assertAuthenticated();
        $response = $this->get('/myAccount/test');

        $response->assertStatus(200);
    }

    public function testGetMyAccountFailed()
    {
        User::create([
            'nickname' => 'test',
            'name' => 'test',
            'nationality' => 'test',
            'lastName' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test')
        ]);

        DB::table('users')->where('nickname', 'test')->limit(1)->update(array('email_verified_at' => '2023-01-07 20:48:38.000'));

        $this->post('/login', [
            'email' => 'test@gmail.com',
            'password' => 'error'
        ]);
        

        $this->assertGuest();
        $response = $this->get('/myAccount/test'); //Found but not opened, user gets redirected to /login
        $response->assertStatus(302);
        $response->assertRedirect('/login');
       
    }

    public function testAdminInterfaceSuccess()
    {
        User::create([
            'nickname' => 'test',
            'name' => 'test',
            'nationality' => 'test',
            'lastName' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test')
        ]);
       
        
        DB::table('users')->where('nickname', 'test')->limit(1)->update(array('isAdmin' => true));

        DB::table('users')->where('nickname', 'test')->limit(1)->update(array('email_verified_at' => '2023-01-07 20:48:38.000'));

        $this->post('/login', [
            'email' => 'test@gmail.com',
            'password' => 'test'
        ]);

        $this->assertAuthenticated();

        $response = $this->get('/admin');

        $response->assertStatus(200);
    }

    public function testAdminInterfaceFailed()
    {
        User::create([
            'nickname' => 'test',
            'name' => 'test',
            'nationality' => 'test',
            'lastName' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test')
        ]);

        DB::table('users')->where('nickname', 'test')->limit(1)->update(array('email_verified_at' => '2023-01-07 20:48:38.000'));

        $this->post('/login', [
            'email' => 'test@gmail.com',
            'password' => 'test'
        ]);

        $this->assertAuthenticated();

        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
    
}
