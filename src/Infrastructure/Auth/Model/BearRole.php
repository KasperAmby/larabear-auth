<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Auth\Model {

    use Carbon\CarbonInterface;
    use Closure;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Query\Builder;

    /**
     * AUTO GENERATED FILE DO NOT MODIFY
     *
     * @method static BearRole|null find(string $id, array $columns = ['*'])
     * @method static BearRole findOrFail(string $id, array $columns = ['*'])
     * @method static BearRole findOrNew(string $id, array $columns = ['*'])
     * @method static BearRole sole(array $columns = ['*'])
     * @method static BearRole|null first(array $columns = ['*'])
     * @method static BearRole firstOrFail(array $columns = ['*'])
     * @method static BearRole firstOrCreate(array $filter, array $values)
     * @method static BearRole firstOrNew(array $filter, array $values)
     * @method static BearRole firstWhere(string $column, string $operator = null, string $value = null, string $boolean = 'and')
     * @method static Collection|BearRole all(array $columns = ['*'])
     * @method static Collection|BearRole fromQuery(string $query, array $bindings = [])
     * @method static Builder|BearRole lockForUpdate()
     * @method static Builder|BearRole select(array $columns = ['*'])
     * @method static Builder|BearRole with(array  $relations)
     * @method static Builder|BearRole leftJoin(string $table, string $first, string $operator = null, string $second = null)
     * @method static Builder|BearRole where(string $column, string $operator = null, string $value = null, string $boolean = 'and')
     * @method static Builder|BearRole whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
     * @method static Builder|BearRole whereHas(string $relation, Closure $callback, string $operator = '>=', int $count = 1)
     * @method static Builder|BearRole whereNull(string|array $columns, string $boolean = 'and')
     * @method static Builder|BearRole whereNotNull(string|array $columns, string $boolean = 'and')
     * @method static Builder|BearRole whereRaw(string $sql, array $bindings = [], string $boolean = 'and')
     * @method static Builder|BearRole orderBy(string $column, string $direction = 'asc')
     *
     * @property string $role_name
     * @property string $role_slug
     * @property string|null $role_description
     * @property CarbonInterface $created_at
     * @property CarbonInterface $updated_at
     *
     * AUTO GENERATED FILE DO NOT MODIFY
     */
    class BearRole extends Model {
        protected $table = 'bear_role';
        protected $primaryKey = 'role_slug';
        protected $keyType = 'string';
        public $incrementing = false;
        protected $dateFormat = 'Y-m-d H:i:sO';

        protected $casts = [
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];

        protected $guarded = ['role_slug','updated_at','created_at','deleted_at'];
    }
}
