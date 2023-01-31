<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Sv1fT\LaravelExchange1C\\ProductProperty
 *
 * @property int $product_id
 * @property int $property_id
 * @property int|null $property_value_id
 * @property string|null $value
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty wherePropertyValueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereValue($value)
 * @mixin \Eloquent
 */
class ProductProperty extends Pivot
{
    //
}
