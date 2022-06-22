<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Oauth2\Model;

use Carbon\CarbonInterface;
use Closure;
use GuardsmanPanda\Larabear\Infrastructure\Database\Cast\BearAsJsonCast;
use stdClass;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AUTO GENERATED FILE DO NOT MODIFY
 *
 * @method static BearOauth2User|null find(string $id, array $columns = ['*'])
 * @method static BearOauth2User findOrFail(string $id, array $columns = ['*'])
 * @method static BearOauth2User findOrNew(string $id, array $columns = ['*'])
 * @method static BearOauth2User sole(array $columns = ['*'])
 * @method static BearOauth2User|null first(array $columns = ['*'])
 * @method static BearOauth2User firstOrFail(array $columns = ['*'])
 * @method static BearOauth2User firstOrCreate(array $filter, array $values)
 * @method static BearOauth2User firstOrNew(array $filter, array $values)
 * @method static BearOauth2User firstWhere(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Collection|BearOauth2User all(array $columns = ['*'])
 * @method static Collection|BearOauth2User fromQuery(string $query, array $bindings = [])
 * @method static Builder|BearOauth2User lockForUpdate()
 * @method static Builder|BearOauth2User select(array $columns = ['*'])
 * @method static Builder|BearOauth2User with(array  $relations)
 * @method static Builder|BearOauth2User leftJoin(string $table, string $first, string $operator = null, string $second = null)
 * @method static Builder|BearOauth2User where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Builder|BearOauth2User whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearOauth2User whereHas(string $relation, Closure $callback, string $operator = '>=', int $count = 1)
 * @method static Builder|BearOauth2User whereNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearOauth2User whereNotNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearOauth2User whereRaw(string $sql, array $bindings = [], string $boolean = 'and')
 * @method static Builder|BearOauth2User orderBy(string $column, string $direction = 'asc')
 *
 * @property string $id
 * @property string $oauth2_scope
 * @property string $oauth2_client_id
 * @property string $oauth2_user_identifier
 * @property string $encrypted_user_access_token
 * @property string|null $linked_user_id
 * @property string|null $oauth2_user_email
 * @property string|null $oauth2_user_name
 * @property string|null $token_refresh_error_message
 * @property string|null $encrypted_user_refresh_token
 * @property stdClass $oauth2_scope_jsonb
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property CarbonInterface $user_access_token_expires_at
 * @property CarbonInterface|null $token_refresh_error_at
 *
 * AUTO GENERATED FILE DO NOT MODIFY
 */
class BearOauth2User extends Model {
    protected $table = 'bear_oauth2_user';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:sO';

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'encrypted_user_access_token' => 'encrypted',
        'encrypted_user_refresh_token' => 'encrypted',
        'oauth2_scope_jsonb' => BearAsJsonCast::class,
        'token_refresh_error_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
        'user_access_token_expires_at' => 'immutable_datetime',
    ];

    protected $guarded = ['id','updated_at','created_at','deleted_at'];
}
