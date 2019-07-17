<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MacroTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        Collection::macro('firstOrThrowException', function ($key, $value) {
            return $this->first(function ($user) use ($key, $value) {
                return $user[$key] == $value;
            }, function () {
                throw new Exception("{$key} not found.");
            });
        });
    }

    /** @test */
    public function collections_are_macroable_found()
    {
        $users = [
            ['id' => 200, 'name' => 'Glenn', 'age' => 32],
            ['id' => 300, 'name' => 'James', 'age' => 31],
            ['id' => 400, 'name' => 'John', 'age' => 40],
        ];

        $user = collect($users)->firstOrThrowException('age', 32);
        $this->assertEquals(200, $user['id']);
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function collections_are_macroable_not_found()
    {
        $users = [
            ['id' => 200, 'name' => 'Glenn', 'age' => 32],
            ['id' => 300, 'name' => 'James', 'age' => 31],
            ['id' => 400, 'name' => 'John', 'age' => 40],
        ];

        $user = collect($users)->firstOrThrowException('age', 55);
    }
}
