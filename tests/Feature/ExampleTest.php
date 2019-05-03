<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testNewClientForm()
    {
        //when open the form page, it will retrive 200 status code
        $response = $this->get('/clients/new');
        $response->assertStatus(200);
    }

    //test a isolated part of the Model
    public function testProfessorOption()
    {        
        $response = $this->get('/clients/new');
        
        //test that the professor entry is there somewhere in the html.
        $this->assertContains(
            'Professor',
            $response->getContent(),            //get the HTML
            'HTML should have Professor'
        );
    }
}
