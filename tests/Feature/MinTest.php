<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MinTest extends TestCase
{

    /** @test */
    public function get_the_minimum_age()
    {
        $users = [
            ['id' => 200, 'name' => 'Glenn', 'age' => 32],
            ['id' => 300, 'name' => 'James', 'age' => 31],
            ['id' => 400, 'name' => 'John', 'age' => 40],
        ];

        // $lowestAge = $this->useRegularPhp($users);
        $lowestAge = $this->useCollections($users);

        $this->assertEquals(31, $lowestAge);
    }

    private function useRegularPhp($users)
    {
        $lowestAge = null;

        if (count($users)) {
            $lowestAge = $users[0]['age'];
        }

        foreach ($users as $user) {
            if ($lowestAge < $user['age']) {
                continue;
            }

            $lowestAge = $user['age'];
        }

        return $lowestAge;
    }

    private function useCollections($users)
    {
        return collect($users)->min->age;
    }
}
