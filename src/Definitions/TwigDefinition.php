<?php

namespace Mosaic\View\Definitions;

use Interop\Container\Definition\DefinitionProviderInterface;
use Mosaic\Common\Conventions\FolderStructureConvention;
use Mosaic\View\Adapters\Twig\Factory as TwigFactory;
use Mosaic\View\Factory;
use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigDefinition implements DefinitionProviderInterface
{
    /**
     * @var FolderStructureConvention
     */
    private $folderStructure;

    /**
     * TwigDefinition constructor.
     * @param FolderStructureConvention $folderStructure
     */
    public function __construct(FolderStructureConvention $folderStructure)
    {
        $this->folderStructure = $folderStructure;
    }

    /**
     * Returns the definition to register in the container.
     *
     * Definitions must be indexed by their entry ID. For example:
     *
     *     return [
     *         'logger' => ...
     *         'mailer' => ...
     *     ];
     *
     * @return array
     */
    public function getDefinitions()
    {
        return [
            Factory::class => function () {
                return new TwigFactory(
                    new Twig_Environment(
                        new Twig_Loader_Filesystem($this->folderStructure->viewPaths()), [
                            'cache' => $this->folderStructure->viewCachePath()
                        ]
                    )
                );
            }
        ];
    }
}
