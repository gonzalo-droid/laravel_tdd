<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     use RefreshDatabase;
     
    public function testStore() {

        $this
            ->post("tags", ["name" => "PHP"])
            ->assertRedirect("/");

        $this->assertDatabaseHas("tags", ["name" => "PHP"]);

    }

    public function testDestroy() {

        $tag = Tag::factory()->create();

        $this
            ->delete("tags/$tag->id")
            ->assertRedirect("/");

        $this->assertDatabaseMissing("tags", ["name" => $tag->name]);
        
    }

    public function test_validate() {

        $this
            ->post("tags", ["name" => ""])
            ->assertSessionHasErrors("name");
        
    }
}
