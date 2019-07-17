<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Collections\UserCollection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomCollectionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function you_can_use_custom_collections()
    {
        $bob = factory(User::class)->create(['email' => 'bob@example.com']);
        $joe = factory(User::class)->create(['email' => 'joe@example.com']);

        $users = User::get();
        $this->assertInstanceOf(UserCollection::class, $users);

        // getEmails is just using pluck('email') on the Users Collection.
        $emails = $users->getEmails();
        $this->assertCount(2, $emails);
        $this->assertContains($bob->email, $emails);
        $this->assertContains($joe->email, $emails);
    }
}
