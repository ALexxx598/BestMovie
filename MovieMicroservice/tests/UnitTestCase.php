<?php

namespace Tests;

use Faker\Generator;
use Illuminate\Foundation\Testing\WithFaker;

class UnitTestCase extends TestCase
{
    use CreatesApplication;
    use WithFaker;

    /**
     * The Faker instance.
     *
     * @var Generator
     */
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpFaker();
    }
}
