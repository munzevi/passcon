<?php

namespace Yerinegetir\N11\Tests;

use Orchestra\Testbench\TestCase;
use Yerinegetir\N11\N11ServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [N11ServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
