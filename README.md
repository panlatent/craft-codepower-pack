# Codepower Pack

Codepower Pack is a plugin to improve the Craft encoding experience. It emphasizes the use of PHP attribute annotations instead of encoding,
including event register, enum assistants, and other useful tools.

## What's this?

Essentially, Codepower Pack simply packages some libraries into a plugin for use directly in the Craft Store. You can directly
Using these libraries, there is no need to install this plugin.

[Event Register](https://github.com/panlatent/craft-event-register) is an event register that can directly register application events in the configuration file.

<details>

<summary>Example</summary>

```php
<?php
// config/events.php

use craft\services\ProjectConfig;
use craft\web\View;
use panlatent\craft\event\register\Bootstrap;
use panlatent\craft\event\register\RegisterEvent;

return [
    #[Bootstrap]
    function($app) {
        if ($app->request->getIsCpRequest()) {
            // ...
        }
    },

    #[RegisterEvent(View::class, View::EVENT_REGISTER_CP_TEMPLATE_ROOTS)]
    function(\craft\events\RegisterTemplateRootsEvent $event) {
        // ...
    },
]
```

</details>

[Enum Helper](https://github.com/panlatent/craft-enums) is an enumeration assistant that automatically generates PHP enumeration 
classes such as Section, Field, etc., so that you can use enumeration items instead of handle strings.

<details>

<summary>Example</summary>

```php
<?php
// Query a section 
Section::post->find()
```

</details>

[Form Schema](https://github.com/panlatent/craft-form-schema) declare form fields via PHP Attribute without writing Twig templates

<details>

<summary>Example</summary>

```php
<?php

use Panlatent\FormSchema\Forms;

class Volume extends \craft\base\Field
{
    // ...
    
    #[Forms\TextInput]
    public ?string $property1 = null;
    
    #[Forms\KeyValue]
    public array $property2 = [];
    
    // ...
}
```

</details>

[Attribute](https://github.com/panlatent/craft-attribute) It is a richer collection of PHP Attributes for Craft

<details>

<summary>Example</summary>

```php
<?php

use panlatent\craft\attribute\web\AllowAnonymous;
use panlatent\craft\attribute\web\RequiredLogin;
use panlatent\craft\attribute\web\HasAttributes;

class UserController extends \craft\web\Controller
{
    use HasAttributes;
    
    #[AllowAnonymous]
    #[RequiredLogin]
    public function actionIndex()
    {
    
    }
}
```

</details>

## Requirements

This plugin requires Craft CMS 5.0 or later, and PHP 8.2 or later.

## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Codepower Pack”. Then press “Install”.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require panlatent/craft-codepower-pack

# tell Craft to install the plugin
./craft plugin/install codepower-pack
```

## Configuration

Copy `config/codepower-pack.php` goes to your application `config/` directory and modify it according to your actual situation.
