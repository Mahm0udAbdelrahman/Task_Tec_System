<?php

namespace Tests;

 use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    const Success = 200;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('config:clear');
    }
}
