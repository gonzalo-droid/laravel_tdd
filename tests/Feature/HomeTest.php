<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;


    public function test_empty() {

        $this
            ->get("/")
            ->assertStatus(200)
            ->assertSee("No hay etiquetas");

    }

    public function test_with_data() {

        $tag = Tag::factory()->create();

        /*
        Antes de los otros assert, se puede agregar un assert para revisar que el name del tag no sea vacío. Así no arroja verde cuando debería arrojar por ser nulo:
        */
        $this->assertNotEmpty($tag->name);

        $this
            ->get("/")
            ->assertStatus(200)
            ->assertSee($tag->name)
            ->assertDontSee("No hay etiquetas");

    }
}
