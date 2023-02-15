<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Sv1fT\Exchange1C\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Sv1fT\LaravelExchange1C\\Product
 *
 * @property int $id
 * @property string $name
 * @property string|null $article
 * @property string $base_unit
 * @property string $accounting_id Код из 1с
 * @property string $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Sv1fT\LaravelExchange1C\\ProductProperty[] $properties
 * @property-read int|null $properties_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAccountingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBaseUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $description
 * @property int|null $group_id
 * @property int|null $catalog_id
 * @property int $is_active
 * @property-read \Illuminate\Database\Eloquent\Collection|\Sv1fT\LaravelExchange1C\\Property[] $propertyValues
 * @property-read int|null $property_values_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Sv1fT\LaravelExchange1C\\Requisite[] $requisites
 * @property-read int|null $requisites_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCatalogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsActive($value)
 */
class Product extends Model implements ProductInterface
{
    use HasFactory;

    protected $fillable = ['name',
        'article',
        'base_unit',
        'category_id',
        'accounting_id'];

    public function properties()
    {
        return $this->belongsToMany(ProductProperty::class);
    }

    public static function getIdFieldName1c()
    {
        return 'accounting_id';
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setRaw1cData($cml, $product)
    {
        // TODO: Implement setRaw1cData() method.
    }

    public function setRequisite1c($name, $value)
    {
        if (!$requisite = Requisite::where('name', $name)->first()) {
            $requisite = new Requisite();
            $requisite->name = $name;
            $requisite->save();
        }
        $this->requisites()->attach($requisite, ['value' => $value]);
    }

    public function setGroup1c($group)
    {
        $id = Category::where('accounting_id' ,$group->id)->pluck('id')->first();
        $this->group_id = $id;
        $this->save();
    }

    public function setProperty1c($property)
    {
        $propertyModel = Property::where('accounting_id', $property->id)->first();
        $propertyValue = $property->getValueModel();
        if ($propertyAccountingId = (string)$propertyValue->ИдЗначения) {
            $value = PropertyValue::where('accounting_id', $propertyAccountingId)->first();
            $attributes = ['property_value_id' => $value->id];
        } else {
            $attributes = ['value' => $propertyValue->value];
        }
        $this->propertyValues()->attach($propertyModel, $attributes);
    }

    public function addImage1c($path, $caption)
    {
        //
    }

    public function getGroup1c()
    {
        return $this->group;
    }

    public static function createProperties1c($properties)
    {
        /**
         * @var \Zenwalker\CommerceML\Model\Property $property
         */
        foreach ($properties as $property) {
            $propertyModel = Property::createByMl($property);
            foreach ($property->getAvailableValues() as $value) {
                if (!$propertyValue = PropertyValue::where('accounting_id', $value->id)->first()) {
                    $propertyValue = new PropertyValue();
                    $propertyValue->name = (string)$value->Значение;
                    $propertyValue->property_id = $propertyModel->id;
                    $propertyValue->accounting_id = (string)$value->ИдЗначения;
                    $propertyValue->save();
                    unset($propertyValue);
                }
            }
        }
    }

    public function getOffer1c($offer)
    {
        $offerModel = Offer::createByMl($offer);
        $offerModel->product_id = $this->id;
        if ($offerModel->getDirtyAttributes()) {
            $offerModel->save();
        }
        return $offerModel;
    }

    public static function createModel1c($product)
    {
        if (!$model = self::where('accounting_id', $product->id)->first()) {
            $model = new self;
            $model->accounting_id = $product->id;
        }
        $model->name = $product->name;
        $model->description = (string)$product->Описание;
        $model->article = (string)$product->Артикул;
        $model->save();
        return $model;
    }

    public static function findProductBy1c(string $id): ?self
    {
        return self::where('accounting_id',$id)->first();
    }

    public function requisites()
    {
        return $this->belongsToMany(Requisite::class)->withPivot('value');
    }
    public function propertyValues()
    {
        return $this->belongsToMany(Property::class)->withPivot(['value','property_value_id']);
    }
}
