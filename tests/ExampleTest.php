<?php

namespace Tests;

use App\Example;

class ExampleTest extends TestCase
{
    public function testExample()
    {
        $example = new Example();

        $this->assertEquals('Hello World.', $example->helloWorld());
    }
}
