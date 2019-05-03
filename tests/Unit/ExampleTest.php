<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Title;              //import Model

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    
    //each test should test 1 thing only
/*     public function testTitlesModelCount()
    {   
        //create instance
        $titles  = new Title();

        /* $value = 1;

        $this->assertTrue(
            1 === $value,               //comparison that should return true
            'Value should be 1'         // error message
        ); */

       /* $this->assertTrue(
            count( $titles->all() ) === 6,
            'It should have 6 titles'
        );
    } */

    //each test should test 1 thing only
    /* public function testLastTitleShouldBeProfessor()
    {
        //create instance
        $titles  = new Title();

        $titles_array=$titles->all();

        $this->assertEquals(
            'Professor',
            array_pop($titles_array),
            'Titles last element should be professor'
        );
    } */


}
