<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModeTest extends TestCase
{
    /**
     * @test
     * the most common value in a set
     */
    public function get_the_mode_of_the_average_user()
    {
        $items = [
            1,
            2,2,2,2,
            3,
            4,
            5,5,
            6
        ];

        // $mode = $this->useRegularPhp($items);
        $mode = $this->useCollections($items);

        $this->assertEquals(2, $mode);
    }

    private function useRegularPhp($items)
    {
        $totals = [];

        foreach ($items as $item) {
            if (! isset($totals[$item])) {
                $totals[$item] = 0;
            }

            $totals[$item]++;
        }

        arsort($totals);

        return array_key_first($totals);
    }

    private function useCollections($items)
    {
        return collect($items)->mode()[0];
    }
}
