<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Sv1fT\LaravelExchange1C\\ProductRequisite
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRequisite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRequisite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRequisite query()
 * @mixin \Eloquent
 * @property int $product_id
 * @property int $requisite_id
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRequisite whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRequisite whereRequisiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductRequisite whereValue($value)
 */
class ProductRequisite extends Pivot
{
    //
}
