<?php

namespace JSomerstone\Cimbic\Test\Integration;

class ResourceTest extends Testcase
{
    /**
     * @test
     */
    public function templatesCssIsIncluded()
    {
        $this->get()
            ->assertOutput('/Template\/default\/css\/default.css/')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function cimpicCssesAreIncluded()
    {
        $this->get()
            ->assertOutput('/StaticFile\/css\/blueprint\/screen/')
            ->assertOutput('/StaticFile\/css\/blueprint\/print/')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function referenceToNonExistingResults404()
    {
        $this->get('StaticFile/css/nothing')
            ->assertStatus(404);
    }
}