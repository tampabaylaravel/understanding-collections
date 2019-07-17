<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PluckTest extends TestCase
{

    /** @test */
    public function get_just_the_name_from_users()
    {
        $users = [
            ['id' => 200, 'name' => 'Glenn', 'age' => 32],
            ['id' => 300, 'name' => 'James', 'age' => 31],
            ['id' => 400, 'name' => 'John', 'age' => 40],
        ];

        // $userNames = $this->useRegularPhp($users);
        $userNames = $this->useCollections($users);

        $this->assertEquals('Glenn', $userNames[0]);
        $this->assertEquals('James', $userNames[1]);
        $this->assertEquals('John', $userNames[2]);
    }

    private function useRegularPhp($users)
    {
        $userNames = [];

        foreach ($users as $user) {
            $userNames[] = $user['name'];
        }

        return $userNames;
    }

    private function useCollections($users)
    {
        return collect($users)->pluck('name');
    }

    /** @test */
    public function get_just_the_name_from_users_keyed_by_id()
    {
        $users = [
            ['id' => 200, 'name' => 'Glenn', 'age' => 32],
            ['id' => 300, 'name' => 'James', 'age' => 31],
            ['id' => 400, 'name' => 'John', 'age' => 40],
        ];

        // $userNames = $this->useRegularPhpById($users);
        $userNames = $this->useCollectionsById($users);

        $this->assertEquals('Glenn', $userNames[200]);
        $this->assertEquals('James', $userNames[300]);
        $this->assertEquals('John', $userNames[400]);
    }

    private function useRegularPhpById($users)
    {
        $userNames = [];

        foreach ($users as $user) {
            $userNames[$user['id']] = $user['name'];
        }

        return $userNames;
    }

    private function useCollectionsById($users)
    {
        return collect($users)->pluck('name', 'id');
    }
}
