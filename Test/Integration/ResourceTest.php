<?php

namespace JSomerstone\Cimbic\Test\Integration;

class ResourceTest extends Testcase
{
    /**
     * @test
     */
    public function cssesAreIncluded()
    {
        $this->get()
            ->assertOutput('/Template\/default\/css\/default.css/')
            ->assertStatus(200);
    }
}