<?php

namespace Mosaic\View;

use Mosaic\Common\Components\AbstractComponent;
use Mosaic\Common\Conventions\FolderStructureConvention;
use Mosaic\View\Providers\TwigProvider;

/**
 * @method static $this twig(FolderStructureConvention $folderStructure)
 */
final class Component extends AbstractComponent
{
    /**
     * @var FolderStructureConvention
     */
    private $folderStructure;

    /**
     * @param string                    $implementation
     * @param FolderStructureConvention $folderStructure
     */
    protected function __construct(string $implementation, FolderStructureConvention $folderStructure)
    {
        $this->folderStructure = $folderStructure;
        parent::__construct($implementation);
    }

    /**
     * @return array
     */
    public function resolveTwig() : array
    {
        return [
            new TwigProvider($this->folderStructure)
        ];
    }

    /**
     * @param  callable $callback
     * @return array
     */
    public function resolveCustom(callable $callback) : array
    {
        return $callback($this->folderStructure);
    }
}
