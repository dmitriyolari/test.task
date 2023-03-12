<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getFixtureJson(string $path): array
    {
        $filePath = $_SERVER['TESTS_PATH'] . '/Fixtures/' . $path;
        return json_decode(file_get_contents($filePath), true);
    }

    protected function getErrorMessages(TestResponse $response): array
    {
        $responseJson = json_decode($response->getContent(), true);
        return $responseJson['errors'];
    }
}
