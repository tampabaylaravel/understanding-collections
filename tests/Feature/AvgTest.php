<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvgTest extends TestCase
{
    /** @test */
    public function get_the_users_average_age()
    {
        $users = [
            ['id' => 200, 'name' => 'Glenn', 'age' => 32],
            ['id' => 300, 'name' => 'James', 'age' => 31],
            ['id' => 400, 'name' => 'John', 'age' => 40],
        ];

        // $averageAge = $this->useRegularPhp($users);
        $averageAge = $this->useCollections($users);

        $this->assertEquals('34', floor($averageAge));
    }

    private function useRegularPhp($users)
    {
        $totalAges = 0;

        foreach ($users as $user) {
            $totalAges += $user['age'];
        }

        $averageAge = null;

        if ($totalAges) {
            $averageAge = $totalAges / count($users);
        }

        return $averageAge;
    }

    private function useCollections($users)
    {
        return collect($users)->avg('age');
    }
}
