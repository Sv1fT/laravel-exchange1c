<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Sv1fT\LaravelExchange1C\\Price
 *
 * @property int $id
 * @property string $performance
 * @property string $value
 * @property string $currency
 * @property float $rate
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price wherePerformance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereValue($value)
 * @mixin \Eloquent
 */
class Price extends Model
{
    use HasFactory;

    public static function createByMl($price, $offer, $type)
    {
        if (!$priceModel = $offer::with(['prices' => function ($query) use ($type, $offer) {
            $query->where('type_id', $type->id);
            $query->wherePivot('offer_id', $offer->id);
        }])->first()->prices->first()) {
            $priceModel = new self();
        }
        $priceModel->value = $price->cost;
        $priceModel->performance = $price->performance;
        $priceModel->currency = $price->currency;
        $priceModel->rate = $price->rate;
        $priceModel->type_id = $type->id;
        $priceModel->save();
        return $priceModel;
    }
}
