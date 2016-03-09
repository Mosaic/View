<?php

namespace Mosaic\View\Tests\Definitions;

use Interop\Container\Definition\DefinitionProviderInterface;
use Mosaic\Application;
use Mosaic\View\Providers\TwigProvider;
use Mosaic\View\Factory;

class TwigDefinitionTest extends \PHPUnit_Framework_TestCase
{
    public function getDefinition() : DefinitionProviderInterface
    {
        return new TwigProvider(new Application(__DIR__));
    }

    public function shouldDefine() : array
    {
        return [
            Factory::class
        ];
    }

    public function test_defines_all_required_contracts()
    {
        $definitions = $this->getDefinition()->getDefinitions();
        foreach ($this->shouldDefine() as $define) {
            $this->assertArrayHasKey($define, $definitions);
        }
    }
}
