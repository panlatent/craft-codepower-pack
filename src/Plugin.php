<?php

namespace panlatent\craft\codepowerpack;

use Craft;
use craft\base\Model;
use craft\base\Plugin as BasePlugin;
use craft\services\ProjectConfig;
use panlatent\craft\codepowerpack\models\Settings;
use panlatent\craft\enums\Enums;
use Symfony\Component\Process\Process;
use yii\base\Event;

/**
 * Code Power Pack plugin
 *
 * @method static Plugin getInstance()
 * @method Settings getSettings()
 * @property-read Settings $settings
 * @author Panlatent <panlatent@gmail.com>
 * @copyright Panlatent
 * @license MIT
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0.0';

    public static function config(): array
    {
        return [
            'components' => [
                // Define component configs here...
            ],
        ];
    }

    public function init(): void
    {
        parent::init();

        $this->attachEventHandlers();

        // Any code that creates an element query or loads Twig should be deferred until
        // after Craft is fully initialized, to avoid conflicts with other plugins/modules
        Craft::$app->onInit(function() {
            // ...
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/5.x/extend/events.html to get started)

        if ($this->getSettings()->autoMakeEnums) {
            Event::on(ProjectConfig::class, ProjectConfig::EVENT_AFTER_WRITE_YAML_FILES, function() {
                (new Process(['php', 'craft', 'make', 'enums', '--path=' . $this->getSettings()->enumPath, '--interactive=1'], Craft::getAlias('@root'), [Enums::DISABLE_INTERACTIVE => true]))->mustRun();
            });
        }
    }
}
