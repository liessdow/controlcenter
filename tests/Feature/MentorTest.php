<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MentorTest extends TestCase
{

    use WithFaker, RefreshDatabase;


    /** 
     * 
     * 
     * 
     * 
     * 
     * 
     * THESE TESTS ARE DISABLED BECAUSE COMMIT bc8f5ac REMOVED THE FUNCTIONS USED
     * The function were never used anywhere in CC, and also posing security risk as AUTH was not setup, ANYONE could call them!
     * 
     * 
     * 
     * 
     * 
     * 
     * 
    public function mentor_can_have_country_added()
    {
        $mentor = factory(User::class)->create(['group' => 3, 'id' => 10000001]);
        $admin = factory(User::class)->create(['group' => 2, 'id' => 10000002]);

        $country = Country::where('name', 'Denmark')->first();

        $this->actingAs($admin)->postJson(route('mentor.add.country', ['user' => $mentor]), ['country' => $country->id])
                ->assertStatus(200)
                ->assertJson(['message' => 'Mentor successfully updated']);

        $this->assertTrue($mentor->training_role_countries->contains($country));
        $this->assertDatabaseHas('training_role_country', ['user_id' => $mentor->id, 'country_id' => $country->id]);
    }


    public function country_can_have_mentor_added()
    {
        $mentor = factory(User::class)->create(['group' => 3, 'id' => 10000001]);
        $admin = factory(User::class)->create(['group' => 2, 'id' => 10000002]);

        $country = Country::where('name', 'Denmark')->first();

        $this->actingAs($admin)->postJson(route('country.add.mentor', ['country' => $country]), ['mentor' => $mentor->id])
                ->assertStatus(200)
                ->assertJson(['message' => 'Mentor successfully added']);

        $this->assertDatabaseHas('training_role_country', ['user_id' => $mentor->id, 'country_id' => $country->id]);
        $this->assertTrue($country->mentors->contains($mentor));
    }


    public function mentor_can_have_country_removed()
    {
        $mentor = factory(User::class)->create(['group' => 3, 'id' => 10000001]);
        $admin = factory(User::class)->create(['group' => 2, 'id' => 10000002]);

        $country = Country::where('name', 'Denmark')->first();

        $this->actingAs($admin)->deleteJson(route('mentor.remove.country', ['user' => $mentor]), ['country' => $country->id])
            ->assertStatus(200)
            ->assertJson(['message' => 'Mentor successfully updated']);

        $this->assertTrue( ! $mentor->training_role_countries->contains($country));
        $this->assertDatabaseMissing('training_role_country', ['user_id' => $mentor->id, 'country_id' => $country->id]);
    }


    public function country_can_have_mentor_removed()
    {
        $mentor = factory(User::class)->create(['group' => 3, 'id' => 10000001]);
        $admin = factory(User::class)->create(['group' => 2, 'id' => 10000002]);

        $country = Country::where('name', 'Denmark')->first();

        $this->actingAs($admin)->deleteJson(route('country.remove.mentor', ['country' => $country]), ['mentor' => $mentor->id])
            ->assertStatus(200)
            ->assertJson(['message' => 'Mentor successfully removed']);

        $this->assertDatabaseMissing('training_role_country', ['user_id' => $mentor->id, 'country_id' => $country->id]);
        $this->assertTrue( ! $country->mentors->contains($mentor));
    }

    */


}
