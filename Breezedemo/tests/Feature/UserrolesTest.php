<?php

use App\Models\User;

test('guest cannot access userroles page', function () {
    $response = $this->get('/praktijkmanagement/gebruikersrollen');
    $response->assertRedirect('/login');
});

test('patient cannot access userroles page', function () {
    $user = User::factory()->create(['role' => 'patient']);

    $response = $this->actingAs($user)->get('/praktijkmanagement/gebruikersrollen');
    $response->assertStatus(403);
});

test('praktijkmanagement can access userroles page', function () {
    $admin = User::factory()->create(['role' => 'praktijkmanagement']);

    $response = $this->actingAs($admin)->get('/praktijkmanagement/gebruikersrollen');
    $response->assertOk();
    $response->assertSee('Gebruikersrollen');
});

test('praktijkmanagement can access edit user role page', function () {
    $admin = User::factory()->create(['role' => 'praktijkmanagement']);
    $user = User::factory()->create(['role' => 'patient']);

    $response = $this->actingAs($admin)->get("/praktijkmanagement/gebruikersrollen/{$user->id}/edit");
    $response->assertOk();
    $response->assertSee($user->name);
    $response->assertSee('Gebruikersrol wijzigen');
});

test('praktijkmanagement can update a user role', function () {
    $admin = User::factory()->create(['role' => 'praktijkmanagement']);
    $user = User::factory()->create(['role' => 'patient']);

    $response = $this->actingAs($admin)->patch("/praktijkmanagement/gebruikersrollen/{$user->id}", [
        'role' => 'tandarts',
    ]);

    $response->assertRedirect('/praktijkmanagement/gebruikersrollen');
    $response->assertSessionHas('success');

    $user->refresh();
    $this->assertEquals('tandarts', $user->role);
});

test('praktijkmanagement cannot update user role with invalid role name', function () {
    $admin = User::factory()->create(['role' => 'praktijkmanagement']);
    $user = User::factory()->create(['role' => 'patient']);

    $response = $this->actingAs($admin)->patch("/praktijkmanagement/gebruikersrollen/{$user->id}", [
        'role' => 'invalid-role',
    ]);

    $response->assertSessionHasErrors(['role']);
    $user->refresh();
    $this->assertEquals('patient', $user->role);
});

test('praktijkmanagement can delete a user', function () {
    $admin = User::factory()->create(['role' => 'praktijkmanagement']);
    $user = User::factory()->create(['role' => 'patient']);

    $response = $this->actingAs($admin)->delete("/praktijkmanagement/gebruikersrollen/{$user->id}");

    $response->assertRedirect('/praktijkmanagement/gebruikersrollen');
    $response->assertSessionHas('success');

    $this->assertNull(User::find($user->id));
});
