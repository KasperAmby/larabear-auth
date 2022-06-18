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
 * @method static BearApplicationAccessToken|null find(string $id, array $columns = ['*'])
 * @method static BearApplicationAccessToken findOrFail(string $id, array $columns = ['*'])
 * @method static BearApplicationAccessToken findOrNew(string $id, array $columns = ['*'])
 * @method static BearApplicationAccessToken sole(array $columns = ['*'])
 * @method static BearApplicationAccessToken|null first(array $columns = ['*'])
 * @method static BearApplicationAccessToken firstOrFail(array $columns = ['*'])
 * @method static BearApplicationAccessToken firstOrCreate(array $filter, array $values)
 * @method static BearApplicationAccessToken firstOrNew(array $filter, array $values)
 * @method static BearApplicationAccessToken firstWhere(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Collection|BearApplicationAccessToken all(array $columns = ['*'])
 * @method static Collection|BearApplicationAccessToken fromQuery(string $query, array $bindings = [])
 * @method static Builder|BearApplicationAccessToken lockForUpdate()
 * @method static Builder|BearApplicationAccessToken select(array $columns = ['*'])
 * @method static Builder|BearApplicationAccessToken with(array  $relations)
 * @method static Builder|BearApplicationAccessToken leftJoin(string $table, string $first, string $operator = null, string $second = null)
 * @method static Builder|BearApplicationAccessToken where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Builder|BearApplicationAccessToken whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearApplicationAccessToken whereHas(string $relation, Closure $callback, string $operator = '>=', int $count = 1)
 * @method static Builder|BearApplicationAccessToken whereNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearApplicationAccessToken whereNotNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearApplicationAccessToken whereRaw(string $sql, array $bindings = [], string $boolean = 'and')
 * @method static Builder|BearApplicationAccessToken orderBy(string $column, string $direction = 'asc')
 *
 * @property int $usage_count
 * @property int|null $delete_all_request_log_after_days
 * @property int|null $delete_get_request_log_after_days
 * @property string $id
 * @property string $api_route_prefix
 * @property string $hashed_access_token
 * @property string $access_token_comment
 * @property string $request_ip_restriction
 * @property string|null $api_primary_key
 * @property string|null $server_hostname_restriction
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property CarbonInterface|null $expires_at
 * @property CarbonInterface|null $last_usage_at
 *
 * AUTO GENERATED FILE DO NOT MODIFY
 */
class BearApplicationAccessToken extends Model {
    protected $table = 'bear_application_access_token';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:sO';

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'expires_at' => 'immutable_datetime',
        'last_usage_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];

    protected $guarded = ['id','updated_at','created_at','deleted_at'];
}
