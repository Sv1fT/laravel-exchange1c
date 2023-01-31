<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Sv1fT\LaravelExchange1C\Models\Property
 *
 * @property int $id
 * @property string $name
 * @property string $accounting_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAccountingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Property extends Model
{
    use HasFactory;

    public static function createByML(\Zenwalker\CommerceML\Model\Property $property)
    {
        if (!$model = self::where('accounting_id' , $property->id)->first()) {
            $model = new self;
            $model->accounting_id = $property->id;
        }
        $model->name = $property->name;
        $model->save();
        return $model;
    }
}
