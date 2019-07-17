<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContainsTest extends TestCase
{
    /** @test */
    public function the_array_contains_a_given_value()
    {
        $users = [32,42,52];

        // $hasValue = $this->useRegularPhp($users, 32);
        $hasValue = $this->useCollections($users, 32);

        $this->assertTrue($hasValue);
    }

    private function useRegularPhp($users, $needle)
    {
        return in_array($needle, $users);
    }

    private function useCollections($users, $needle)
    {
        return collect($users)->contains($needle);
    }

    /** @test */
    public function the_multidimensional_array_contains_a_given_value()
    {
        $users = [
            ['id' => 200, 'name' => 'Glenn', 'age' => 32],
            ['id' => 300, 'name' => 'James', 'age' => 31],
            ['id' => 400, 'name' => 'John', 'age' => 40],
        ];

        // $hasValue = $this->useRegularPhpForMultidimensionalSearch($users, 32);
        // $hasValue = $this->useCollectionWithCallback($users, 32);
        $hasValue = $this->useCollectionWithWithKey($users, 32);

        $this->assertTrue($hasValue);
    }

    private function useRegularPhpForMultidimensionalSearch($users, $needle)
    {
        $hasValue = false;

        foreach ($users as $user) {
            if ($user['age'] != $needle) {
                continue;
            }

            $hasValue = true;
            break;
        }

        return $hasValue;
    }

    private function useCollectionWithCallback($users, $needle)
    {
        return collect($users)->contains(function ($user) use ($needle) {
            return $user['age'] == $needle;
        });
    }

    private function useCollectionWithWithKey($users, $needle)
    {
        return collect($users)->contains('age', $needle);
    }
}
