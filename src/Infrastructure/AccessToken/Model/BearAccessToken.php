<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\AccessToken\Model;

use Carbon\CarbonInterface;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AUTO GENERATED FILE DO NOT MODIFY
 *
 * @method static BearAccessToken find(string $id, array $columns = ['*'])
 * @method static BearAccessToken findOrFail(string $id, array $columns = ['*'])
 * @method static BearAccessToken findOrNew(string $id, array $columns = ['*'])
 * @method static BearAccessToken sole(array $columns = ['*'])
 * @method static BearAccessToken first(array $columns = ['*'])
 * @method static BearAccessToken firstOrFail(array $columns = ['*'])
 * @method static BearAccessToken firstOrCreate(array $filter, array $values)
 * @method static BearAccessToken firstOrNew(array $filter, array $values)
 * @method static BearAccessToken|null firstWhere(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Collection|BearAccessToken all(array $columns = ['*'])
 * @method static Collection|BearAccessToken fromQuery(string $query, array $bindings = [])
 * @method static Builder|BearAccessToken lockForUpdate()
 * @method static Builder|BearAccessToken select(array $columns = ['*'])
 * @method static Builder|BearAccessToken with(array $relations)
 * @method static Builder|BearAccessToken leftJoin(string $table, string $first, string $operator = null, string $second = null)
 * @method static Builder|BearAccessToken where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Builder|BearAccessToken whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearAccessToken whereHas(string $relation, Closure $callback, string $operator = '>=', int $count = 1)
 * @method static Builder|BearAccessToken whereNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearAccessToken whereNotNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearAccessToken whereRaw(string $sql, array $bindings, string $boolean = 'and')
 * @method static Builder|BearAccessToken orderBy(string $column, string $direction = 'asc')
 *
 * @property int $usage_count
 * @property int $delete_all_request_log_after_days
 * @property int $delete_get_request_log_after_days
 * @property string $id
 * @property string $ip_restriction
 * @property string $api_primary_key
 * @property string $api_route_prefix
 * @property string $created_by_user_id
 * @property string $hashed_access_token
 * @property string $access_token_comment
 * @property CarbonInterface $created_at
 * @property CarbonInterface $expires_at
 * @property CarbonInterface $last_usage_at
 *
 * AUTO GENERATED FILE DO NOT MODIFY
 */
class BearAccessToken extends Model {
    protected $table = 'bear_access_token';
    protected $dateFormat = 'Y-m-d H:i:sO';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'expires_at' => 'immutable_datetime',
        'last_usage_at' => 'immutable_datetime',
    ];

    protected $guarded = ['id', 'updated_at', 'created_at', 'deleted_at'];
}
