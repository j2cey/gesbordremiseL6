<?php

namespace App;

use Illuminate\Support\Carbon;

/**
 * Class Bordereauremise
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $name
 * @property float $price
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Product extends BaseModel
{
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @return array
     */
    protected $casts = [
        'price' => 'float',
    ];
}
