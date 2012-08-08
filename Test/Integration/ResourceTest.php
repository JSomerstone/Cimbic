<?php

namespace JSomerstone\Cimbic\Test\Integration;

class ResourceTest extends Testcase
{
    /**
     * @test
     */
    public function sitesCssesAreIncluded()
    {
        $this->get()
            ->assertOutput('/css\/base.css/')
            ->assertStatus(200);
    }

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
    public function sitesJavascriptsAreIncluded()
    {
        $this->get()
            ->assertOutput('/js\/empty.js/')
            ->assertStatus(200);
    }
}