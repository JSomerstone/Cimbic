<?php
namespace JSomerstone\Cimbic\Test\Integration;

class StaticFileTest extends Testcase
{
    /**
     * @test
     */
    public function referenceToNonExistingResults404()
    {
        $this->get('StaticFile/css/nothing')
            ->assertStatus(404);
    }

    /**
     * @test
     */
    public function requestForBlueprintFileSuccees()
    {
        $this->get('StaticFile/css/blueprint/screen')
            ->assertStatus(200)
            ->assertOutput('/Blueprint CSS Framework/');
        
        $this->get('StaticFile/css/blueprint/print')
            ->assertStatus(200)
            ->assertOutput('/Blueprint CSS Framework/');
    }
}