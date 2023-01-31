<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Sv1fT\LaravelExchange1C\\PropertyValue
 *
 * @property int $id
 * @property int $property_id
 * @property string $name
 * @property string $accounting_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyValue whereAccountingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyValue whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyValue wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyValue whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PropertyValue extends Model
{
    use HasFactory;
}
