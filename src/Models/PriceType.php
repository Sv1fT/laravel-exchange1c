<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Sv1fT\LaravelExchange1C\\PriceType
 *
 * @property int $id
 * @property string $accounting_id
 * @property string $name
 * @property string $currency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereAccountingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PriceType extends Model
{
    use HasFactory;

    protected $fillable = ['accounting_id', 'name', 'currency'];

    public static function createByMl($type)
    {
        if (!$priceType = self::where('accounting_id', $type->id)->first()) {
            $priceType = new self;
            $priceType->accounting_id = $type->id;
        }
        $priceType->name = $type->name;
        $priceType->currency = (string)$type->Валюта;
        if ($priceType->getDirtyAttributes()) {
            $priceType->save();
        }
        return $priceType;
    }

    public function getDirtyAttributes($names = null)
    {
        if ($names === null) {
            $names = $this->attributes;
        }

        $attributes = [];
        if ($this->_oldAttributes === null) {
            foreach ($this->attributes as $name => $value) {

                if (isset($names[$name])) {

                    $attributes[$name] = $value;
                }
            }
        } else {
            foreach ($this->attributes as $name => $value) {
                if (isset($names[$name]) && (!array_key_exists($name, $this->_oldAttributes) || $this->isAttributeDirty($name, $value))) {
                    $attributes[$name] = $value;
                }
            }
        }

        return $attributes;
    }
}
