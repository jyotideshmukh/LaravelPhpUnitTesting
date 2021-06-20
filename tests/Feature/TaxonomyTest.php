<?php

namespace Tests\Feature;

use App\Models\Taxonomy;
use App\Models\User;
use Database\Factories\TaxonomyFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaxonomyTest extends TestCase
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

      //******************************************************/
        /* checked for post, get , database saving, 200 status*/
       /* $taxonomy = [
          'title'=>$this->faker->sentence,
          'parent'=>0,
          'description'=>$this->faker->paragraph
        ];
        //$response = $this->post('/tags',$taxonomy);
        //$response->assertStatus(200);
        //$this->assertDatabaseHas('taxonomies',$taxonomy);
        //$response = $this->get('/tags');
        //$response->assertSee($taxonomy['title']);

       //******************************************************/
        //this fails as system not redirecting- as title blank
       // $taxonomy = Taxonomy::factory()->raw(['title'=>'']);

        //this will pass as system redirecting
        $this->actingAs(User::factory()->create());
        $taxonomy = Taxonomy::factory()->raw();
        /*checked for redirecting correctly*/
         $this->post('/tags',$taxonomy)->assertRedirect('/tags');
        //******************************************************
    }

    /*
     * Adding test for Title required in taxonomy
     */
    public function test_taxonomy_requires_title(){
        $this->actingAs(User::factory()->create());
        //this test get passed as we are sending blank array and it throws title error
        $this->post('/tags',[])->assertSessionHasErrors('title');

        //now checking with factory- overwritten title of factory with blank
        $taxonomyData = Taxonomy::factory()->raw(['title'=>'']);
        $this->post('/tags',$taxonomyData)->assertSessionHasErrors('title');
    }

    /*
     * Adding test for description not required in taxonomy
     */

    /*public function test_taxonomy_requires_description(){

        $this->post('/tags',[])->assertSessionHasErrors('description');
    }*/

    /**
     * Checking for taxonomy created by its id
     */

    public function test_is_taxonomy_created_and_accessible(){
        $this->withExceptionHandling();
        $taxonomy = Taxonomy::factory()->create();
        $this->get('/tags/'.$taxonomy->id)
            ->assertSee($taxonomy['title'])
            ->assertSee($taxonomy['description']);
    }

    /**
     * Check Taxonomy has owner
     */
    /*public function test_a_taxonomy_requires_a_owner(){
        $this->actingAs(User::factory()->create());
        $taxonomy = Taxonomy::factory()->raw(['owner_id'=>null]);
        $this->post('/tags',$taxonomy)->assertSessionHasErrors('owner_id');
    }*/

    /**
     * Check Taxonomy has authenticated Owner
     * check if user is authenticated else redirect to login page
     */
    public function test_only_authenticated_user_can_post_taxonomy()
    {
        $this->withExceptionHandling();
        $taxonomy = Taxonomy::factory()->raw(['owner_id' => null]);
        //lets test - before even executing post- it should check authenicated user
        $this->post('/tags', $taxonomy)->assertRedirect('/login');
    }

    /*public function test_a_authenticated_users_taxonomies_create(){
        Auth::user()->projets()->create(Taxonomy::factory()->raw());
    }*/
}
