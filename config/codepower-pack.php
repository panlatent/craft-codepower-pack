<?php

use craft\helpers\App;

return [
    'autoMakeEnums' => App::env('CRAFT_ENVIRONMENT') === 'dev',

    /**
     * This path is relative to the project root directory, and it must be able to find the corresponding namespace through Composer.
     * Usually configured as `app` or `src` for most projects, make sure composer.json meets the requirements.
     *
     * For example(app):
     *
     * ```json
     * {
     *     "autoload": {
     *         "psr-4": {
     *              "App\\": "app/"
     *          }
     *      },
     * }
     * ```
     */
    'enumPath' => App::env('ENUM_PATH') ?: '',
];