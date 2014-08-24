<?php namespace Streams\Addon\Module\Addons\Installer;

use Streams\Core\Stream\Installer\StreamInstaller;

class AddonStreamSchemaAbstract extends StreamInstaller
{
    /**
     * The stream fields assignments definitions.
     *
     * @var array
     */
    protected $assignments = [
        'slug'         => ['is_required' => true],
        'is_enabled'   => ['is_required' => true],
        'is_installed' => ['is_required' => true],
    ];
}