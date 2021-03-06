<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

/**
 * Class AddonsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Http\Controller\Admin
 */
class AddonsController extends AdminController
{

    /**
     * Return an index of existing entries.
     *
     * @param AddonTableBuilder $builder
     * @param string            $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AddonTableBuilder $builder, $type = 'modules')
    {
        $builder->setType($type);

        return $builder->render();
    }

    /**
     * Return the details for an addon.
     *
     * @param AddonCollection $addons
     * @param                 $addon
     */
    public function details(AddonCollection $addons, $addon)
    {
        /* @var Addon $addon */
        $addon = $addons->get($addon);

        $json = $addon->getComposerJson();

        return view('module::ajax/details', compact('json', 'addon'))->render();
    }

    /**
     * Install an addon.
     *
     * @param AddonCollection  $addons
     * @param ModuleManager    $modules
     * @param ExtensionManager $extensions
     * @param                  $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function install(AddonCollection $addons, ModuleManager $modules, ExtensionManager $extensions, $addon)
    {
        /* @var Addon $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->install($addon);
        } elseif ($addon instanceof Extension) {
            $extensions->install($addon);
        }

        $this->messages->success('module::message.install_addon_success');

        return $this->redirect->back();
    }

    /**
     * Uninstall an addon.
     *
     * @param AddonCollection  $addons
     * @param ModuleManager    $modules
     * @param ExtensionManager $extensions
     * @param                  $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uninstall(AddonCollection $addons, ModuleManager $modules, ExtensionManager $extensions, $addon)
    {
        /* @var Addon $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->uninstall($addon);
        } elseif ($addon instanceof Extension) {
            $extensions->uninstall($addon);
        }

        $this->messages->success('module::message.uninstall_addon_success');

        return $this->redirect->back();
    }
}
