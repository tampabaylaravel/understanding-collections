<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MapTest extends TestCase
{
    /** @test */
    public function capitalize_all_the_names_php()
    {
        $names = ['glenn', 'james', 'john'];

        // $names = $this->useRegularPhp($names);
        $names = $this->useCollections($names);

        $this->assertEquals('Glenn', $names[0]);
        $this->assertEquals('James', $names[1]);
        $this->assertEquals('John', $names[2]);
    }

    private function useRegularPhp($names)
    {
        foreach ($names as $key => $value) {
            $names[$key] = ucfirst($value);
        }

        return $names;
    }

    private function useCollections($names)
    {
        return collect($names)->map(function ($name) {
            return ucfirst($name);
        });
    }
}
