<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getFixtureJson(string $path)
    {
        $filePath = $_SERVER['TESTS_PATH'] . '/Fixtures/' . $path;
        return json_decode(file_get_contents($filePath), true);
    }
}
