<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Organizer;
use App\User;


class OrganizerTest extends TestCase
{
    use WithFaker;
    
    
    public function testIndex(){
        // Authenticate the user
            $this->authenticate();
        // Access to the page
            $response = $this->get('/organizers')
                             ->assertStatus(200);
    }
 
    
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
            $response = $this->post('/organizers', $data);
            
        // Assert in database
            $this->assertDatabaseHas('organizers',$data);
            
        // Status
            $response->assertStatus(302); // I aspect redirect (301 or 302) because after store get redirected to teachers.index
    
    }
    
    /*public function a_logged_user_can_create_teacher(){
        
        
    }*/
}
