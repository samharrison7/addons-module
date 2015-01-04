<?php namespace Anomaly\AddonsModule\Ui\Table\Theme\Handler;

use Anomaly\Streams\Platform\Addon\Theme\Theme;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Theme
 */
class ColumnHandler extends \Anomaly\AddonsModule\Ui\Table\ColumnHandler
{

    /**
     * Handle table columns.
     *
     * @return array
     */
    public function handle()
    {
        return [
            [
                'heading' => 'module::admin.addon',
                'value'   => function (Theme $entry) {
                        return view('module::themes/table/theme', compact('entry'));
                    },
            ],
            [
                'heading' => 'module::admin.authors',
                'value'   => function (Theme $entry) {
                        return $this->authors($entry);
                    }
            ],
            [
                'heading' => 'module::admin.link',
                'value'   => function (Theme $entry) {
                        return $this->link($entry);
                    }
            ],
            [
                'heading' => 'module::admin.support',
                'value'   => function (Theme $entry) {
                        return $this->support($entry);
                    }
            ]
        ];
    }
}