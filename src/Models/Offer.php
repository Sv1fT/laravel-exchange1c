<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Sv1fT\Exchange1C\Interfaces\OfferInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Sv1fT\LaravelExchange1C\\Offer
 *
 * @property int $id
 * @property string $name
 * @property string $accounting_id
 * @property int $product_id
 * @property string $remnant
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereAccountingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereRemnant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Offer extends Model implements OfferInterface
{
    use HasFactory;

    public static function createByMl($offer)
    {
        if (!$offerModel = self::where('accounting_id', $offer->id)->first()) {
            $offerModel = new self;
            $offerModel->name = (string)$offer->name;
            $offerModel->accounting_id = (string)$offer->id;
        }
        $offerModel->remnant = (string)$offer->Количество;
        $offerModel->save();
        return $offerModel;
    }

    public function getExportFields1c($context = null)
    {
        // TODO: Implement getExportFields1c() method.
    }

    public static function getIdFieldName1c()
    {
        // TODO: Implement getIdFieldName1c() method.
    }

    public function getPrimaryKey()
    {
        // TODO: Implement getPrimaryKey() method.
    }

    public function getGroup1c()
    {
        return $this->product->group;
    }

    public function setPrice1c($price)
    {
        $priceType = PriceType::where('accounting_id', $price->getType()->id)->first();
        $priceModel = Price::createByMl($price, $this, $priceType);
        $this->prices()->attach($priceModel);
    }

    public static function createPriceTypes1c($types)
    {
        foreach ($types as $type) {
            PriceType::createByML($type);
        }
    }

    public function setSpecification1c($specification)
    {
        $specificationModel = Specification::createByMl($specification);
        $this->specifications()->attach($specificationModel, ['value' => (string)$specification->Значение]);
    }

    public function prices()
    {
        return $this->belongsToMany(Price::class);
    }

    public function specifications()
    {
        return $this->belongsToMany(Specification::class)->withPivot('value');
    }

    public function getDirtyAttributes($names = null)
    {
        if ($names === null) {
            $names = $this->attributes;
        }
        $names = array_flip($names);
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
