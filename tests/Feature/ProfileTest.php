<?php

namespace Tests\Feature;

use App\User;
use App\Posts;
use App\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    

    protected function actingAsAdmin(){
        $this->actingAs(User::create(['username'=>'Sadof',
                                    'email' => 's@a.dof',
                                    'password' => '$2y$10$Y5tZzpWv50kL11KWKgkM8.nbZoDO9SsE./bIs9.enD.97dlapIt0S']));
    }

    protected function createUser($username){
        return User::create(['username'=> $username,
                                    'email' => $username .'@m.r',
                                    'password' => '$2y$10$Y5tZzpWv50kL11KWKgkM8.nbZoDO9SsE./bIs9.enD.97dlapIt0S']);
    }




    /** @test */
    public function registration_store_test()
    {
        $response = $this->post('/register', ['username' => 'Sadof', 'email' => 's@a.dof', 'password' => 'qwerty123', 'password_confirmation' => 'qwerty123'])->assertRedirect('/home');
        $this->assertCount(1, User::all());
    }

    public function login_test()
    {
        $user = $this->createUser('Sadof');
        $response = $this->post('/login', ['username' => $user->username, 'password' => $user->password])->assertOk();
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function only_logged_in_users_can_use_home_page()
    {
        $response = $this->get('/home')->assertRedirect('/login');

    }


    /** @test */    
    public function authenticated_users_can_use_home_page()
    {
        $this->actingAsAdmin();
        $response = $this->get('/home')->assertStatus(200);
    }

    /** @test */
    public function retrieve(){

    }

    /** @test */
    public function edit_page_test()
    {
        $user1 = User::create([
                                'username'=>'Sadof',
                                'email' => 's@a.dof',
                                'password' => '$2y$10$Y5tZzpWv50kL11KWKgkM8.nbZoDO9SsE./bIs9.enD.97dlapIt0S']);
        $user2 = User::create([
                                'username'=>'Alirem',
                                'email' => 'a@a.dof',
                                'password' => '$2y$10$Y5tZzpWv50kL11KWKgkM8.nbZoDO9SsE./bIs9.enD.97dlapIt01']);

        $response = $this->be($user1)->get('/profile/'.$user1->id.'/edit')->assertOk();
        $response = $this->be($user1)->get('/profile/'.$user2->id.'/edit')->assertStatus(403);
        $response = $this->be($user2)->get('/profile/'.$user2->id.'/edit')->assertOk();
        $response = $this->be($user2)->get('/profile/'.$user1->id.'/edit')->assertStatus(403);
       
    }

    /** @test */
    public function edit_page_test_update()
    {
        $user = $this->createUser('Sadof');

        Storage::fake('profile');

        $png = UploadedFile::fake()->image('avatar.png');
        $data = ['name'=> 'Maxim','surname' => 'U','bio' => 'Retard','image' => $png];
        $response = $this->be($user)->post('/profile/'.$user->id, $data)->assertStatus(405);
        $response = $this->be($user)->put('/profile/'.$user->id , $data)->assertStatus(405);
        $response = $this->be($user)->patch('/profile/'.$user->id, $data)->assertRedirect('/profile/'.$user->id);
        $profile = Profile::first();
        assert($profile->name == 'Maxim');
        assert($profile->surname == 'U');
        assert($profile->bio == 'Retard');
        
    }



    /** @test */
    public function only_logged_in_users_can_create_test()
    {
        $response = $this->get('p/create/')->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_create_test()
    {
        $this->actingAsAdmin();
        $response = $this->get('/p/create')->assertStatus(200);
    }

    /** @test */
    public function only_logged_in_users_can_store_test()
    {
        $response = $this->post('p/')->assertRedirect('/login');
    }


    /** @test */
    public function post_store_test()
    {   

        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAsAdmin();

        $response = $this->post('/p/', ['title' => 'lul',
                                        'text' => 'I\'d like to do smth',
                                        'image' => $file]);
        $this->assertCount(1,Posts::all());
    }

    /** @test */
    public function post_store_test_validation()
    {   

        Storage::fake('avatars');

        $png = UploadedFile::fake()->image('avatar.png');
        $jpeg = UploadedFile::fake()->image('avatar.jpeg');
        $this->actingAsAdmin();
        $data = ['title' => 'lugf','text' => 'I\'d like to do smth', "image" => ''];
        $response = $this->post('/p/', array_merge(
                                    $data,
                                    ['image' => $png]));
        $response = $this->post('/p/',array_merge(
                                    $data,
                                    ['image' => $jpeg]));

        $this->assertCount(2,Posts::all());
    }

    

    /** @test */
    public function check_follow_profile()
    {
        $user1 = $this->createUser('Sadof');
        $user2 = $this->createUser('Mesuni');
        $user3 = $this->createUser('Alirem');
        $this->be($user1)->post('/follow/'. $user2->id)->assertOk();
        $this->be($user1)->post('/follow/'. $user3->id)->assertOk();
        $this->be($user2)->post('/follow/'. $user1->id)->assertOk();
        $this->be($user3)->post('/follow/'. $user1->id)->assertOk();
        $this->assertCount(2, $user1->following);
        $this->assertCount(2, $user1->profile->followers);
        $this->assertCount(1, $user2->profile->followers);
        $this->assertCount(1, $user3->profile->followers);
    }

    /** @test */
    public function post_delete_test()
    {
        $user = $this->createUser('Sadof');
        Storage::fake('avatars');

        $png = UploadedFile::fake()->image('avatar.png');
        $post = $user->posts()->create(['title' => 'Smth',
                                        'text' => 'Post default text',
                                        'image' => $png]);
        $this->assertCount(1, Posts::all());
        $response = $this->delete('/p/' . $post->id)->assertStatus(403);
        $response = $this->be($user)->delete('/p/' . $post->id)->assertRedirect('/profile/' . $user->id);
        $this->assertCount(0, Posts::all());
    }

}
