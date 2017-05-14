<?php

namespace Tests\Siren\Fixtures;

use LogicException;

class FixtureHelper
{
    const FIXTURE_DIR = 'Json';

    /**
     * Helper method to load a fixture string from the fixture directory
     *
     * @param string $fixtureName
     * @return string
     * @throws LogicException
     */
    public function getFixture($fixtureName)
    {
        $filePath = __DIR__ . DIRECTORY_SEPARATOR . self::FIXTURE_DIR .
            DIRECTORY_SEPARATOR . $fixtureName . '.json';

        if (is_readable($filePath)) {
            return file_get_contents($filePath);
        }

        $exMsg = sprintf('Fixture path `%s` is not readable', $filePath);
        throw new LogicException($exMsg);
    }
}
