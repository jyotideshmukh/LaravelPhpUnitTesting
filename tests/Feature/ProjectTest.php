<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use WithFaker;//, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /*public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    public function test_is_project_tag_systemworking(){
        $this->withExceptionHandling();

        $taxonomy = [
          'title'=>$this->faker->sentence,
          'parent'=>0,
          'description'=>$this->faker->paragraph
        ];
        $response = $this->post('/tags',$taxonomy);

        $response->assertStatus(200);

        $this->assertDatabaseHas('taxonomies',$taxonomy);

        $response = $this->get('/tags');

        $response->assertSee($taxonomy);

    }
}
