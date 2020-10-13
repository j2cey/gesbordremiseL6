<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Setting
 * @package App
 *
 * @property integer $id
 * @property string $group
 * @property string $name
 * @property string|null $value
 * @property string $type
 * @property string $array_sep
 * @property string|null $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Setting extends Model
{
    public static function getAllGrouped() {
        $final_array = [];

        try {
            $collection = Setting::all()->groupBy('group');

            foreach ($collection as $group => $coll) {
                foreach ($coll as $sett) {
                    $final_array[$group][$sett->name] = self::getParsedValue($sett);
                }
            }
            return $final_array;
        } catch (\Exception $e) {
            return [];
        }
    }

    private static function getParsedValue(Setting $setting) {
        if ($setting->type === "string") {
            return $setting->value;
        } elseif ($setting->type === "integer") {
            return (int)$setting->value;
        } elseif ($setting->type === "bool") {
            return (bool)$setting->value;
        } elseif ($setting->type === "float") {
            return (float)$setting->value;
        } elseif ($setting->type === "array") {
            return explode($setting->array_sep, $setting->value);
        }
        return $setting->value;
    }
}
