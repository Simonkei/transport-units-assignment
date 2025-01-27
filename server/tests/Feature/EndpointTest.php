<?php

use App\Models\TransportUnit;

it('successfully response for index', function () {

    TransportUnit::factory()->count(5)->create();

    $response = $this->get('/api/transportUnits');

    $response->assertStatus(200);

    $response->assertJson(
        fn($json) =>
        $json->has('data')->etc()
    );
});

it('successfully created a transport unit', function () {
    $data = ['type' => 'truck', 'name' => 'Mann'];

    $response = $this->post('/api/transportUnits', $data);

    $response->assertStatus(201)
        ->assertJsonFragment($data);


    $this->assertDatabaseHas('transport_units', $data);
});

it('successfully retrieved a transport unit', function () {

    $transportUnit = TransportUnit::factory()->create();

    $response = $this->get("/api/transportUnits/{$transportUnit->id}");

    $response->assertStatus(200)
        ->assertJsonFragment([
            'id' => $transportUnit->id,
            'name' => $transportUnit->name,
            'type' => $transportUnit->type,
        ]);
});
