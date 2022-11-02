<?php

namespace Tests\Feature;

use App\Models\Parte;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_get_all_partes()
    {

        $partes = Parte::factory(4)->create();


        $this->getJson(route('partes.index'))->assertJsonFragment([
            'nombre' => $partes[0]->nombre
        ])->assertJsonFragment([
            'nombre' => $partes[1]->nombre
        ]);
    }

    /** @test */
    function can_get_one_parte()
    {
        $parte = Parte::factory()->create();

        $this->getJson(route('partes.show', $parte))
            ->assertJsonFragment([
                'nombre' => $parte->nombre
            ]);
    }

    /** @test */
    function can_create_partes()
    {
        $this->postJson(route('partes.store'), [])
            ->assertJsonValidationErrorFor('nombre');

        $this->postJson(route('partes.store'), [
            'nombre' => 'My nueva Parte'
        ])->assertJsonFragment([
            'nombre' => 'My nueva Parte'
        ]);

        $this->assertDatabaseHas('partes', [
            'nombre' => 'My nueva Parte'
        ]);
    }


    /** @test */

    function can_update_partes()
    {

        $parte = parte::factory()->create();

        $this->patchJson(route('partes.update', $parte), [])
            ->assertJsonValidationErrorFor('nombre');

        $this->patchJson(route('partes.update', $parte), [
            'nombre' => 'Parte Editada'
        ])->assertJsonFragment([
            'nombre' => 'Parte Editada'
        ]);

        $this->assertDatabaseHas('partes', [
            'nombre' => 'Parte Editada'
        ]);
    }

    /** @test */
    function can_delete_partes()
    {

        $parte = parte::factory()->create();

        $this->deleteJson(route('partes.destroy', $parte))->assertNoContent();

        $this->assertDatabaseCount('partes', 0);
    }
}
