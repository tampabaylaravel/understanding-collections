<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReduceTest extends TestCase
{
    /** @test */
    public function total_salaries()
    {
        $users = [
            ['name' => 'Glenn', 'salary' => 10000],
            ['name' => 'James', 'salary' => 15000],
            ['name' => 'John', 'salary' => 500],
        ];

        // $totalSalaries = $this->useRegularPhp($users);
        // $totalSalaries = $this->useCollections($users);
        // $totalSalaries = $this->useCollectionsSum($users);
        $totalSalaries = $this->useCollectionsSumHigherOrderMessage($users);

        $this->assertEquals(25500, $totalSalaries);
    }

    private function useRegularPhp($users)
    {
        $totalSalaries = 0;

        foreach ($users as $user) {
            $totalSalaries += $user['salary'];
        }

        return $totalSalaries;
    }

    private function useCollections($users)
    {
        return collect($users)->reduce(function ($carry, $item) {
            return $carry + $item['salary'];
        }, 0);
    }

    private function useCollectionsSum($users)
    {
        return collect($users)->sum('salary');
    }

    private function useCollectionsSumHigherOrderMessage($users)
    {
        return collect($users)->sum->salary;
    }
}
