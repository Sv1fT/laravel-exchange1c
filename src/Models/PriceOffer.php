<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Sv1fT\LaravelExchange1C\\PriceOffer
 *
 * @property int $price_id
 * @property int $offer_id
 * @method static \Illuminate\Database\Eloquent\Builder|PriceOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceOffer whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceOffer wherePriceId($value)
 * @mixin \Eloquent
 */
class PriceOffer extends Pivot
{
    //
}
