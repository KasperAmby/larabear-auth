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
 * @method static BearAccessTokenUser|null find(string $id, array $columns = ['*'])
 * @method static BearAccessTokenUser findOrFail(string $id, array $columns = ['*'])
 * @method static BearAccessTokenUser sole(array $columns = ['*'])
 * @method static BearAccessTokenUser|null first(array $columns = ['*'])
 * @method static BearAccessTokenUser firstOrFail(array $columns = ['*'])
 * @method static BearAccessTokenUser firstOrCreate(array $filter, array $values)
 * @method static BearAccessTokenUser firstOrNew(array $filter, array $values)
 * @method static BearAccessTokenUser firstWhere(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Collection|BearAccessTokenUser all(array $columns = ['*'])
 * @method static Collection|BearAccessTokenUser fromQuery(string $query, array $bindings = [])
 * @method static Builder|BearAccessTokenUser lockForUpdate()
 * @method static Builder|BearAccessTokenUser select(array $columns = ['*'])
 * @method static Builder|BearAccessTokenUser with(array  $relations)
 * @method static Builder|BearAccessTokenUser leftJoin(string $table, string $first, string $operator = null, string $second = null)
 * @method static Builder|BearAccessTokenUser where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Builder|BearAccessTokenUser whereExists(Closure $callback, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearAccessTokenUser whereNotExists(Closure $callback, string $boolean = 'and')
 * @method static Builder|BearAccessTokenUser whereHas(string $relation, Closure $callback, string $operator = '>=', int $count = 1)
 * @method static Builder|BearAccessTokenUser whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearAccessTokenUser whereNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearAccessTokenUser whereNotNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearAccessTokenUser whereRaw(string $sql, array $bindings = [], string $boolean = 'and')
 * @method static Builder|BearAccessTokenUser orderBy(string $column, string $direction = 'asc')
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
class BearAccessTokenUser extends Model {
    protected $connection = 'pgsql';
    protected $table = 'bear_access_token_user';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:sO';
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'expires_at' => 'immutable_datetime',
        'invalid_at' => 'immutable_datetime',
    ];

    protected $guarded = ['id', 'updated_at', 'created_at', 'deleted_at'];
}
