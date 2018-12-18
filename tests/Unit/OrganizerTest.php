<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganizerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;  // empty the test DB

    /***************************************************************************/
    /**
     * Populate test DB with dummy data
     */ 
    public function setUp()
    {
        parent::setUp();
        // Seeders - /database/seeds
            $this->seed();
        
        // Seeders - /database/factories
            $this->organizer = factory(\App\Organizer::class)->create();
    }

    /***************************************************************************/
    /**
     * Test that logged user can see organizers index view
     */  
    public function test_logged_user_can_see_organizers(){
        // Authenticate the user
            $this->authenticate();
        
        // Access to the page
            $response = $this->get('/organizers')
                             ->assertStatus(200);
    }
 
    /***************************************************************************/
    /**
     * Test that guest user can see an organizer
     */  
    public function test_guest_user_can_see_single_organizer(){
            
        // Access to the page (teacher.show)
            $response = $this->get('/en/organizers/'.$this->organizer->id.'/')
                         ->assertStatus(200);
    }
    
    /***************************************************************************/
    /**
     * Test that logged user can create an organizer
     */  
    public function test_a_logged_user_can_create_organizer()
    {
        // Authenticate the user
            $this->authenticate();
    
        // Post a data to create teacher (I dont' post created_by and slub becayse are generated by the store method )
            $data = [
                'name' => $this->faker->name,
                'website' => $this->faker->url,
                'description' => $this->faker->paragraph,
                'email' => $this->faker->email,
                'phone' => $this->faker->e164PhoneNumber,
            ];
            $response = $this
                        ->followingRedirects()
                        ->post('/organizers', $data);
            
        // Assert in database
            $this->assertDatabaseHas('organizers',$data);
            
        // Status
            $response
                    ->assertStatus(200)
                    ->assertSee(__('general.organizer').__('views.created_successfully'));
    
    }
    

}
