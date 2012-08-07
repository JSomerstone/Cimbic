<?php

namespace JSomerstone\Cimbic\Test\Integration;

class MainPageTest extends Testcase
{

    /**
     * @test
     */
    public function mainPageShownOnEmptyUrl()
    {
        $this->get()
            ->assertOutput('/Fake site frontpage/')
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function correctContentIsRetreaved()
    {
        $expectedContent = file_get_contents(__DIR__ . '/../Data/FakeSite/Content/page1.htm');
        $this->get('page1')
            ->assertOutput("/$expectedContent/")
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function correctContentIsRetreavedFromHierarchy()
    {
        $expectedContent = file_get_contents(__DIR__ . '/../Data/FakeSite/Content/page1/subpageAlpha.htm');
        $this->get('page1/subpageAlpha')
            ->assertOutput("/$expectedContent/")
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function requestToNonExistingCauces404Page()
    {
        $this->get('page1/nonExistingContent')
            ->assertOutput("/Error 404 - Not found/")
            ->assertStatus(404);
    }

    /**
     * @test
     */
    public function baseUrlIsGeneratedCorrectly()
    {
        $this->get()
            ->assertOutput('|http://localhost/sites/fakesites.net|')
            ->assertStatus(200);
    }
}