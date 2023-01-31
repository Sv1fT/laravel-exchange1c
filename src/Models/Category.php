<?php

namespace Sv1fT\LaravelExchange1C\Models;

use App\Services\Import1CService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sv1fT\Exchange1C\Interfaces\GroupInterface;

/**
 * Sv1fT\LaravelExchange1C\\Category
 *
 * @property int $id
 * @property string $name Наименование группы
 * @property string|null $parent_id Родительская группа
 * @property string|null $accounting_id Код в 1С
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Sv1fT\LaravelExchange1C\\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereAccountingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model implements GroupInterface
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id', 'accounting_id'];

    /**
     * Возвращаем имя поля в базе данных, в котором хранится ID из 1с
     *
     * @return string
     */
    public static function getIdFieldName1c()
    {
        return 'accounting_id';
    }
    /**
     * Создание дерева групп
     * в параметр передаётся массив всех групп (import.xml > Классификатор > Группы)
     * $groups[0]->parent - родительская группа
     * $groups[0]->children - дочерние группы
     *
     * @param \Zenwalker\CommerceML\Model\Group[] $groups
     * @return void
     */
    public static function createTree1c($groups)
    {
        foreach ($groups as $group) {
            self::createByML($group);
            if ($children = $group->getChildren()) {
                self::createTree1c($children);
            }
        }
    }
    /**
     * Создаём группу по модели группы CommerceML
     * проверяем все дерево родителей группы, если родителя нет в базе - создаём
     *
     * @param \Zenwalker\CommerceML\Model\Group $group
     * @return Group|array|null
     */
    public static function createByML(\Zenwalker\CommerceML\Model\Group $group)
    {
        if (!$model = self::where('accounting_id' , $group->id)->first()) {
            $model = new self;
            $model->accounting_id = $group->id;
        }
        $model->name = $group->name;
        if ($parent = $group->getParent()) {
            $parentModel = self::createByML($parent);
            $model->parent_id = $parentModel->id;
            unset($parentModel);
        } else {
            $model->parent_id = null;
        }
        $model->save();
        return $model;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'accounting_id');
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
}
