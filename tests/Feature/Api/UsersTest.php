<?php
declare(strict_types=1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

describe('Test create user expected Success', function () {
    it('Test create user not log in expected error', function () {
       $testUser = [
         'name' => "Patryk test",
         'email' => "patryk@test.pl",
         'password' => "patryk123",
         'password_confirmation' => "patryk123",
       ];

       $response = postJson(route('user.store'), $testUser);

       $response->assertStatus(401);

       unset($testUser['password']);
       unset($testUser['password_confirmation']);

       assertDatabaseMissing('users', $testUser);
    });

    it('Test create user by super admin expected success', function () {
       $testUser = [
         'name' => "Patryk test",
         'email' => "patryk@test.pl",
         'password' => "patryk123",
         'password_confirmation' => "patryk123",
       ];
       $user = User::factory()->make([
           'super_admin' => true
       ]);

       $response = actingAs($user)
       ->postJson(route('user.store'), $testUser);

       $response->assertOk();

       unset($testUser['password']);
       unset($testUser['password_confirmation']);

       expect($response->json('data'))
           ->toMatchArray($testUser);
       assertDatabaseHas('users', $testUser);
    });

    it('Attempt create user with super admin permission by super admin expected success and not super admin permission for new user', function () {
       $testUser = [
         'name' => "Patryk test",
         'email' => "patryk@test.pl",
         'password' => "patryk123",
         'password_confirmation' => "patryk123",
         'super_admin' => true,
       ];
       $user = User::factory()->make([
           'super_admin' => true
       ]);

       $response = actingAs($user)
       ->postJson(route('user.store'), $testUser);

       $response->assertOk();

       unset($testUser['password']);
       unset($testUser['super_admin']);
       unset($testUser['password_confirmation']);

       expect($response->json('data'))
           ->toMatchArray($testUser);
        $testUser['super_admin'] = false;
       assertDatabaseHas('users', $testUser);
    });

    it('Test create user without super admin permission expected error', function () {
       $testUser = [
         'name' => "Patryk test",
         'email' => "patryk@test.pl",
         'password' => "patryk123",
         'password_confirmation' => "patryk123",
       ];
       $user = User::factory()->make([
           'super_admin' => false
       ]);

       $response = actingAs($user)
       ->postJson(route('user.store'), $testUser);

       $response->assertStatus(403);

       unset($testUser['password']);
       unset($testUser['password_confirmation']);

       assertDatabaseMissing('users', $testUser);
    });

    it('Test create user without confirmation password by super admin expected Error', function () {
        $testUser = [
            'name' => "Patryk test",
            'email' => "patryk@test.pl",
            'password' => "patryk123",
            'password_confirmation' => "patryk 114 4",
        ];
        $user = User::factory()->make([
            'super_admin' => true
        ]);

        $response = actingAs($user)
            ->postJson(route('user.store'), $testUser);

        $response->assertStatus(422);

        unset($testUser['password']);
        unset($testUser['password_confirmation']);

        assertDatabaseMissing('users', $testUser);
    });

    it('Test create user when email is double by super admin expected error', function () {

       $testUser = User::factory()
           ->make([
               'email' => 'test@wp.pl',
               'password' => "patryk123",
               'password_confirmation' => "patryk123",
           ])->toArray();

       User::factory()
           ->create([
           'email' => 'test@wp.pl'
       ]);

        $user = User::factory()->make([
            'super_admin' => true
        ]);

       $response = actingAs($user)
       ->postJson(route('user.store'), $testUser);

       $response->assertStatus(422);

       unset($testUser['password']);
       unset($testUser['password_confirmation']);

       assertDatabaseMissing('users', $testUser);
    });

    it('Test create user when select input not isset by super admin expected error', function (string $nameInput) {

        $user = User::factory()->make([
            'super_admin' => true
        ]);
        $testUser = User::factory()
            ->make([
                'email' => 'test@wp.pl',
                'password' => "patryk123",
                'password_confirmation' => "patryk123",
            ])->toArray();

        unset($testUser[$nameInput]);

        $response = actingAs($user)
        ->postJson(route('user.store'), $testUser);

        $response->assertStatus(422);

        unset($testUser['password']);
        unset($testUser['password_confirmation']);

        assertDatabaseMissing('users', $testUser);
    })->with('userinputsname');
});


describe('User index route', function () {
   it('Expected list isset User', function () {
      $users = User::factory()
          ->count(10)
          ->create()
          ->toArray();

      $user = User::factory()->make();

      $response = actingAs($user)
       ->getJson(route('user.index'));

      $response->assertOk();

      expect($response->json('data'))
          ->toMatchArray($users);

   });

    it('View list users not log in expected error', function () {
        $users = User::factory()
            ->count(10)
            ->create()
            ->toArray();

        $response = getJson(route('user.index'));

        $response->assertStatus(401);

    });

});

describe('User delete route', function () {

    it('Remove User not logged in expected Error', function () {

        $user = User::factory()->create();

        deleteJson(
            route('user.destroy', $user->id)
        )->assertStatus(401);


        assertDatabaseHas('users', [
            'id' => $user->id
        ]);
    });

    it('Remove isset User with super admin permission expected success', function () {
        $user = User::factory()
            ->create()
            ->toArray();

        $userLogIn = User::factory()->make([
            'super_admin' => true
        ]);

        $response = actingAs($userLogIn)
            ->deleteJson(
            route('user.destroy', $user['id'])
        );

        $response->assertStatus(100);

        assertDatabaseMissing('users', [
            'id' => $user['id']
        ]);

    });
    it('Remove not isset User expected success', function () {
        $user = User::factory()
            ->create()
            ->toArray();

        $userLogIn = User::factory()->create([
            'super_admin' => true
        ]);

        $userLogIn['super_admin'] = true;
        $userLogIn->save();

        $response = actingAs($userLogIn)
            ->deleteJson(
            route('user.destroy', 9769)
        );

        $response->assertStatus(100);

        assertDatabaseMissing('users', [
            'id' => 9769
        ]);

    });

    it('Remove isset User without super admin permission expected error', function () {
        $user = User::factory()
            ->create()
            ->toArray();

        $userLogIn = User::factory()->make();

        $response = actingAs($userLogIn)
            ->deleteJson(
            route('user.destroy', $user['id'])
        );

        $response->assertStatus(403);

        assertDatabaseHas('users', $user);

    });

});
