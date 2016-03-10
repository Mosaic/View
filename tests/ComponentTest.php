<?php

namespace Mosaic\View\Tests;

use Mosaic\Common\Conventions\DefaultFolderStructure;
use Mosaic\View\Component;
use Mosaic\View\Providers\TwigProvider;

class ComponentTest extends \PHPUnit_Framework_TestCase
{
    public function test_can_resolve_twig()
    {
        $folder = new DefaultFolderStructure(__DIR__);

        $component = Component::twig($folder);

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('twig', $component->getImplementation());
        $this->assertEquals([new TwigProvider($folder)], $component->getProviders());
    }

    public function test_can_resolve_custom()
    {
        $folder = new DefaultFolderStructure(__DIR__);

        Component::extend('customView', function ($folder) {
            return [
                new TwigProvider($folder)
            ];
        });

        $component = Component::customView($folder);

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('customView', $component->getImplementation());
        $this->assertEquals([new TwigProvider($folder)], $component->getProviders());
    }
}
