<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Auth\Model;

use Carbon\CarbonInterface;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AUTO GENERATED FILE DO NOT MODIFY
 *
 * @method static BearPermission|null find(string $id, array $columns = ['*'])
 * @method static BearPermission findOrFail(string $id, array $columns = ['*'])
 * @method static BearPermission findOrNew(string $id, array $columns = ['*'])
 * @method static BearPermission sole(array $columns = ['*'])
 * @method static BearPermission|null first(array $columns = ['*'])
 * @method static BearPermission firstOrFail(array $columns = ['*'])
 * @method static BearPermission firstOrCreate(array $filter, array $values)
 * @method static BearPermission firstOrNew(array $filter, array $values)
 * @method static BearPermission firstWhere(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Collection|BearPermission all(array $columns = ['*'])
 * @method static Collection|BearPermission fromQuery(string $query, array $bindings = [])
 * @method static Builder|BearPermission lockForUpdate()
 * @method static Builder|BearPermission select(array $columns = ['*'])
 * @method static Builder|BearPermission with(array  $relations)
 * @method static Builder|BearPermission leftJoin(string $table, string $first, string $operator = null, string $second = null)
 * @method static Builder|BearPermission where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Builder|BearPermission whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearPermission whereHas(string $relation, Closure $callback, string $operator = '>=', int $count = 1)
 * @method static Builder|BearPermission whereNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearPermission whereNotNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearPermission whereRaw(string $sql, array $bindings = [], string $boolean = 'and')
 * @method static Builder|BearPermission orderBy(string $column, string $direction = 'asc')
 *
 * @property string $permission_name
 * @property string $permission_slug
 * @property string|null $permission_description
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * AUTO GENERATED FILE DO NOT MODIFY
 */
class BearPermission extends Model {
    protected $table = 'bear_permission';
    protected $primaryKey = 'permission_slug';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:sO';

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];

    protected $guarded = ['permission_slug','updated_at','created_at','deleted_at'];
}
