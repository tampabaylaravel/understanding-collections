<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniqueTest extends TestCase
{
    /** @test */
    public function get_only_the_unique_records()
    {
        $people = [
            'Glenn', 'Glenn', 'Glenn',
            'James', 'James', 'James',
            'John', 'John', 'John',
        ];

        // $uniquePeople = $this->useRegularPhp($people);
        $uniquePeople = $this->useCollections($people);

        $this->assertCount(3, $uniquePeople);
        $this->assertContains('Glenn', $uniquePeople);
        $this->assertContains('James', $uniquePeople);
        $this->assertContains('John', $uniquePeople);
    }

    private function useRegularPhp($people)
    {
        $uniquePeople = [];

        foreach ($people as $person) {
            if (in_array($person, $uniquePeople)) {
                continue;
            }

            $uniquePeople[] = $person;
        }

        return $uniquePeople;
    }

    private function useCollections($people)
    {
        return collect($people)->unique();
    }
}
