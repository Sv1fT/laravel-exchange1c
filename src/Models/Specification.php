<?php

namespace Sv1fT\LaravelExchange1C\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    public static function createByMl($specification)
    {
        if (!$specificationModel = self::where('name', $specification->name)->first()) {
            $specificationModel = new self;
            $specificationModel->name = $specification->name;
            $specificationModel->save();
        }
        return $specificationModel;
    }
}
