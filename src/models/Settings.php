<?php

namespace panlatent\craft\codepowerpack\models;

use Craft;
use craft\base\Model;

class Settings extends Model
{
    public bool $autoMakeEnums = false;

    /**
     * @var string
     */
    public string $enumPath = '';
}