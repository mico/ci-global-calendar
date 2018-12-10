<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Teacher;
use App\User;


class TeacherTest extends TestCase
{
    use WithFaker;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        // Authenticate the user
            $this->authenticate();
        
        // Post a data to create teacher
            $data = [
                'name' => $this->faker->name,
                'bio' => $this->faker->paragraph,
                'year_starting_practice' => "2000",
                'year_starting_teach' => "2006",
                'significant_teachers' => $this->faker->paragraph,
                'website' => $this->faker->url,
                'facebook' => "https://www.facebook.com/".$this->faker->word,
                'country_id' => $this->faker->numberBetween($min = 1, $max = 253),
            ];
            $response = $this->post('/teachers', $data);
            
        // Assert in database
            $this->assertDatabaseHas('teachers',$data);
            
        // Status
            $response->assertStatus(302); // I aspect redirect (301 or 302) because after store get redirected to teachers.index
    
    }
    
    /*public function a_logged_user_can_create_teacher(){
        
        
    }*/
}
