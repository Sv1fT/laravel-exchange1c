<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Sv1fT\LaravelExchange1C\\Requisite
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requisite whereUpdatedAt($value)
 */
class Requisite extends Model
{
    use HasFactory;
}
