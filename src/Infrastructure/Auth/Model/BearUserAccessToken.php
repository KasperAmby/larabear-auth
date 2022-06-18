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
 * @method static BearUserAccessToken|null find(string $id, array $columns = ['*'])
 * @method static BearUserAccessToken findOrFail(string $id, array $columns = ['*'])
 * @method static BearUserAccessToken findOrNew(string $id, array $columns = ['*'])
 * @method static BearUserAccessToken sole(array $columns = ['*'])
 * @method static BearUserAccessToken|null first(array $columns = ['*'])
 * @method static BearUserAccessToken firstOrFail(array $columns = ['*'])
 * @method static BearUserAccessToken firstOrCreate(array $filter, array $values)
 * @method static BearUserAccessToken firstOrNew(array $filter, array $values)
 * @method static BearUserAccessToken firstWhere(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Collection|BearUserAccessToken all(array $columns = ['*'])
 * @method static Collection|BearUserAccessToken fromQuery(string $query, array $bindings = [])
 * @method static Builder|BearUserAccessToken lockForUpdate()
 * @method static Builder|BearUserAccessToken select(array $columns = ['*'])
 * @method static Builder|BearUserAccessToken with(array  $relations)
 * @method static Builder|BearUserAccessToken leftJoin(string $table, string $first, string $operator = null, string $second = null)
 * @method static Builder|BearUserAccessToken where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Builder|BearUserAccessToken whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearUserAccessToken whereHas(string $relation, Closure $callback, string $operator = '>=', int $count = 1)
 * @method static Builder|BearUserAccessToken whereNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearUserAccessToken whereNotNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearUserAccessToken whereRaw(string $sql, array $bindings = [], string $boolean = 'and')
 * @method static Builder|BearUserAccessToken orderBy(string $column, string $direction = 'asc')
 *
 * @property int $expiry_time_increment_in_minutes
 * @property string $id
 * @property string $user_id
 * @property string $hashed_access_token
 * @property CarbonInterface $created_at
 * @property CarbonInterface $expires_at
 * @property CarbonInterface $invalid_at
 *
 * AUTO GENERATED FILE DO NOT MODIFY
 */
class BearUserAccessToken extends Model {
    protected $table = 'bear_user_access_token';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:sO';
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'expires_at' => 'immutable_datetime',
        'invalid_at' => 'immutable_datetime',
    ];

    protected $guarded = ['id','updated_at','created_at','deleted_at'];
}
