<?php

/**
 * Stargazing theme for Flarum.
 *
 * LICENSE: For the full copyright and license information,
 * please view the LICENSE.md file that was distributed
 * with this source code.
 *
 * @package    the-turk/flarum-stargazing-theme
 * @author     Hasan Özbey <hasanoozbey@gmail.com>
 * @copyright  2020
 * @license    The MIT License
 * @version    Release: 0.1.0-beta.1
 * @link       https://github.com/the-turk/flarum-stargazing-theme
 */

namespace TheTurk\Stargazing;

use Flarum\Extend;
use Flarum\Foundation\Application;
use Flarum\Frontend\Assets;
use Flarum\Frontend\Compiler\Source\SourceCollector;
use TheTurk\Stargazing;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),
    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/less/forum.less')
        ->content(Stargazing\Listeners\AddAssets::class),
    (new Extend\Locales(__DIR__ . '/locale')),
    function (Application $app) {
        $settings = $app['flarum.settings'];

        $app->resolving('flarum.assets.forum', function (Assets $assets) use ($settings) {
            $assets->css(function (SourceCollector $sources) use ($settings) {
                $sources->addString(function () use ($settings) {
                    $relocateSidebar = (bool)$settings->get('the-turk-stargazing-theme.relocateSidebar', true);

                    $vars = [
                        'config-right-sidebar' => $relocateSidebar ? 'true' : 'false',
                    ];

                    return array_reduce(array_keys($vars), function ($string, $name) use ($vars) {
                        return $string."@$name: {$vars[$name]};";
                    }, '');
                });
            });
        });
    }
];
