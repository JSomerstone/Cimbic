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
    public function cimbicCssesAreIncluded()
    {
        $this->get()
            ->assertOutput('/cimbic\/css\/blueprint\/screen.css/')
            ->assertOutput('/cimbic\/css\/blueprint\/print.css/')
            ->assertOutput('/cimbic\/css\/dark-hive\/jquery-ui.css/')
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

    /**
     * @test
     */
    public function cimbicJavascriptsAreIncluded()
    {
        $this->get()
            ->assertOutput('/cimbic\/js\/jquery.js/')
            ->assertOutput('/cimbic\/js\/jquery-ui.js/')
            ->assertOutput('/cimbic\/js\/underscore.js/')
            ->assertOutput('/cimbic\/js\/backbone.js/')
            ->assertOutput('/cimbic\/js\/vie.js/')
            ->assertOutput('/cimbic\/js\/hallo.js/')
            ->assertOutput('/cimbic\/js\/create.js/')
            ->assertStatus(200);
    }
}