<?php

namespace Mosaic\View\Tests\Providers;

use Interop\Container\Definition\DefinitionProviderInterface;
use Mosaic\Common\Conventions\DefaultFolderStructure;
use Mosaic\View\Factory;
use Mosaic\View\Providers\TwigProvider;

class TwigProviderTest extends \PHPUnit_Framework_TestCase
{
    public function getDefinition() : DefinitionProviderInterface
    {
        return new TwigProvider(new DefaultFolderStructure(__DIR__));
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
