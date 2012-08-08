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
            ->assertOutput('/Fake site frontpage/') //from frontpage.htm
            ->assertOutput('/Welcome/') //from frontpage.json
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

    /**
     * @test
     */
    public function pageTitleIsShownCorrectly()
    {
        $this->get('page1')
            ->assertOutput("/Page I/") //This comes from page1.json
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function siteTitleIsShownCorrectly()
    {
        $this->get('page1')
            ->assertOutput("/Page I - Fakesite/") //This comes from page1.json and settings.json
            ->assertStatus(200);
    }
}