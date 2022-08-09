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
 * @method static BearAccessTokenApp|null find(string $id, array $columns = ['*'])
 * @method static BearAccessTokenApp findOrFail(string $id, array $columns = ['*'])
 * @method static BearAccessTokenApp sole(array $columns = ['*'])
 * @method static BearAccessTokenApp|null first(array $columns = ['*'])
 * @method static BearAccessTokenApp firstOrFail(array $columns = ['*'])
 * @method static BearAccessTokenApp firstOrCreate(array $filter, array $values)
 * @method static BearAccessTokenApp firstOrNew(array $filter, array $values)
 * @method static BearAccessTokenApp firstWhere(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Collection|BearAccessTokenApp all(array $columns = ['*'])
 * @method static Collection|BearAccessTokenApp fromQuery(string $query, array $bindings = [])
 * @method static Builder|BearAccessTokenApp lockForUpdate()
 * @method static Builder|BearAccessTokenApp select(array $columns = ['*'])
 * @method static Builder|BearAccessTokenApp with(array  $relations)
 * @method static Builder|BearAccessTokenApp leftJoin(string $table, string $first, string $operator = null, string $second = null)
 * @method static Builder|BearAccessTokenApp where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Builder|BearAccessTokenApp whereExists(Closure $callback, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearAccessTokenApp whereNotExists(Closure $callback, string $boolean = 'and')
 * @method static Builder|BearAccessTokenApp whereHas(string $relation, Closure $callback, string $operator = '>=', int $count = 1)
 * @method static Builder|BearAccessTokenApp whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearAccessTokenApp whereNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearAccessTokenApp whereNotNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearAccessTokenApp whereRaw(string $sql, array $bindings = [], string $boolean = 'and')
 * @method static Builder|BearAccessTokenApp orderBy(string $column, string $direction = 'asc')
 *
 * @property int $usage_count
 * @property int $delete_all_request_log_after_days
 * @property int $delete_get_request_log_after_days
 * @property string $id
 * @property string $hashed_access_token
 * @property string $access_token_purpose
 * @property string $request_ip_restriction
 * @property string $route_prefix_restriction
 * @property string|null $api_primary_key
 * @property string|null $server_hostname_restriction
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property CarbonInterface|null $expires_at
 * @property CarbonInterface|null $last_usage_at
 *
 * AUTO GENERATED FILE DO NOT MODIFY
 */
class BearAccessTokenApp extends Model {
    protected $connection = 'pgsql';
    protected $table = 'bear_access_token_app';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:sO';

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'expires_at' => 'immutable_datetime',
        'last_usage_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];

    protected $guarded = ['id', 'updated_at', 'created_at', 'deleted_at'];
}