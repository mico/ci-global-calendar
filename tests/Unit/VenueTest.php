<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VenueTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;  // empty the test DB

    /***************************************************************************/

    /**
     * Populate test DB with dummy data.
     */
    public function setUp(): void
    {
        parent::setUp();
        // Seeders - /database/seeds
        $this->seed();
                
        // Factories
        $this->withFactories(base_path('vendor/davide-casiraghi/laravel-events-calendar/database/factories'));
        $this->venue = factory(\DavideCasiraghi\LaravelEventsCalendar\Models\EventVenue::class)->create();
    }

    /***************************************************************************/

    /**
     * Test that guest user can see organizers index view.
     */
    public function test_logged_user_can_see_venue()
    {
        // Authenticate the user
        $this->authenticate();

        // Access to the page
        $response = $this->get('/eventVenues')
                             ->assertStatus(200);
    }

    /***************************************************************************/

    /**
     * Test that guest user can see an venue.
     */
    public function test_guest_user_can_see_single_venue()
    {

        // Access to the page (teacher.show)
        $response = $this->get('/eventVenues/'.$this->venue->id.'/')
                         ->assertStatus(200);
    }

    /***************************************************************************/

    /**
     * Test that registered user can create an venue.
     */
    public function test_a_logged_user_can_create_venue()
    {
        // Authenticate the user
        $this->authenticate();

        // Post a data to create teacher (I dont' post created_by and slub becayse are generated by the store method )
        $description = $this->faker->paragraph;
        $data = [
                'name' => $this->faker->name,
                'description' => $description,
                'website' => $this->faker->url,
                'continent_id' => 3,
                'country_id' => 2,
                'city' => $this->faker->city,
                'address' => $this->faker->address,
                'zip_code' => $this->faker->postcode,
            ];
        $response = $this
                        ->followingRedirects()
                        ->post('/eventVenues', $data);

        // Assert in database
        $data['description'] = clean($description);
        $this->assertDatabaseHas('event_venues', $data);

        // Status
        $response
                    ->assertStatus(200)
                    ->assertSee(__('messages.venue_added_successfully'));
    }

    /***************************************************************************/

    /**
     * Test that guest user can UPDATE a venue.
     */
    public function test_guest_user_can_update_venue()
    {

        // Authenticate the user
        $this->authenticate();

        // Update the post
        $this->venue->name = 'New Name';
        $response = $this
                        ->followingRedirects()
                        ->put('/eventVenues/'.$this->venue->id, $this->venue->toArray())
                        ->assertSee(__('messages.venue_updated_successfully'));

        // Check the update on DB
        $this->assertDatabaseHas('event_venues', ['id'=> $this->venue->id, 'name' => 'New Name']);
    }

    /***************************************************************************/

    /**
     * Test that guest user can DELETE an venue.
     */
    public function test_guest_user_can_delete_venue()
    {

        // Authenticate the user
        $this->authenticate();

        // Delete the post
        $response = $this
                        ->followingRedirects()
                        ->delete('/eventVenues/'.$this->venue->id, $this->venue->toArray())
                        ->assertSee(__('messages.venue_deleted_successfully'));

        // Check the update on DB
        $this->assertDatabaseMissing('event_venues', ['id'=> $this->venue->id]);
    }
}
