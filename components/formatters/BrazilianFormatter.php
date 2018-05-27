<?php

namespace app\components\formatters;

use yii\i18n\Formatter;

class BrazilianFormatter extends Formatter
{
    public static function asStatus($value)
    {
        return $value ? 'Active' : 'Inactive';
    }

    public static function asStatusHighlighted($value)
    {
        return $value ? '<span class="text-info"><strong>Active</strong></span>' : 
        '<span class="text-warning"><strong>Inactive</strong></span>';
    }

    public static function asHighlight($value)
    {
        return $value ? 'Yes' : 'No';
    }
}