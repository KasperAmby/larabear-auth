<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Oauth2\Model;

use Carbon\CarbonInterface;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AUTO GENERATED FILE DO NOT MODIFY
 *
 * @method static BearOauth2Client|null find(string $id, array $columns = ['*'])
 * @method static BearOauth2Client findOrFail(string $id, array $columns = ['*'])
 * @method static BearOauth2Client findOrNew(string $id, array $columns = ['*'])
 * @method static BearOauth2Client sole(array $columns = ['*'])
 * @method static BearOauth2Client|null first(array $columns = ['*'])
 * @method static BearOauth2Client firstOrFail(array $columns = ['*'])
 * @method static BearOauth2Client firstOrCreate(array $filter, array $values)
 * @method static BearOauth2Client firstOrNew(array $filter, array $values)
 * @method static BearOauth2Client firstWhere(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Collection|BearOauth2Client all(array $columns = ['*'])
 * @method static Collection|BearOauth2Client fromQuery(string $query, array $bindings = [])
 * @method static Builder|BearOauth2Client lockForUpdate()
 * @method static Builder|BearOauth2Client select(array $columns = ['*'])
 * @method static Builder|BearOauth2Client with(array  $relations)
 * @method static Builder|BearOauth2Client leftJoin(string $table, string $first, string $operator = null, string $second = null)
 * @method static Builder|BearOauth2Client where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
 * @method static Builder|BearOauth2Client whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
 * @method static Builder|BearOauth2Client whereHas(string $relation, Closure $callback, string $operator = '>=', int $count = 1)
 * @method static Builder|BearOauth2Client whereNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearOauth2Client whereNotNull(string|array $columns, string $boolean = 'and')
 * @method static Builder|BearOauth2Client whereRaw(string $sql, array $bindings = [], string $boolean = 'and')
 * @method static Builder|BearOauth2Client orderBy(string $column, string $direction = 'asc')
 *
 * @property string $id
 * @property string $oauth2_client_id
 * @property string $oauth2_token_uri
 * @property string $oauth2_client_slug
 * @property string $oauth2_client_type
 * @property string $oauth2_authorize_uri
 * @property string $oauth2_client_description
 * @property string $encrypted_oauth2_client_secret
 * @property string|null $api_base_uri
 * @property string|null $oauth2_client_scope
 * @property string|null $encrypted_oauth2_client_access_token
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property CarbonInterface|null $oauth2_client_access_token_expires_at
 *
 * AUTO GENERATED FILE DO NOT MODIFY
 */
class BearOauth2Client extends Model {
    protected $table = 'bear_oauth2_client';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:sO';

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'encrypted_oauth2_client_access_token' => 'encrypted',
        'encrypted_oauth2_client_secret' => 'encrypted',
        'oauth2_client_access_token_expires_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];

    protected $guarded = ['id','updated_at','created_at','deleted_at'];
}
