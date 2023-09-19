<?php

namespace App\AppMain\Repositories;

use Closure;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;
    protected $query;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    abstract public function getModel();

    /**
     * @var array
     */
    private $allowed_operator = [
        '>', '>=', '=', '!=', '<>', '<', '<=',
        'like', 'not like', 'in', 'not in', 'is null',
        'has', 'doenst have', 'between', 'not between'
    ];

    /**
     * @var array
     */
    private $allowed_order = ["asc", "desc"];

    protected function getQueryBuilder()
    {
        return $this->query = $this->model->newQuery();
    }

    public function all(array $columns = ['*'])
    {
        return $this->getQueryBuilder()->get($columns);
    }

    public function allWithOne($with, array $columns = ['*'])
    {
        return $this->getQueryBuilder()->with($with)->get($columns);
    }

    public function pluck($key, $value)
    {
        return $this->all([$key, $value])->pluck($key, $value);
    }

    public function findWhere(array $conditions = [], array $with = [], array $columns = ['*'], int|null $limit = 20, int|null $offset = 0, array $orderBy = [])
    {
        $this->getQueryBuilder();
        $this->addCondition($conditions);

        $this->query->when($offset, function($query) use($offset){
            $query->offset($offset);
        });
        $this->query->when($limit, function($query) use($limit){
            $query->limit($limit);
        });
        $this->query->when(!empty($with), function($query) use($with){
            $query->with($with);
        });

        $result = $this->orderBy($orderBy)->get($columns);
        if ($result && count($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }

    public function find($id, array $columns = ['*'])
    {
        return $this->getQueryBuilder()->find($id, $columns);
    }

    public function findOne($attribute, $value, array $columns = ['*'])
    {
        return $this->getQueryBuilder()->where($attribute, "=", $value)->first($columns);
    }

    public function findWhereOne(array $conditions = [], array $with = [], array $columns = ['*'], int $limit = 20, int $offset = 0, array $orderBy = [])
    {
        $this->getQueryBuilder();
        $this->addCondition($conditions);

        $this->query->when($offset, function($query) use($offset){
            $query->offset($offset);
        });
        $this->query->when($limit, function($query) use($limit){
            $query->limit($limit);
        });
        $this->query->when(!empty($with), function($query) use($with){
            $query->with($with);
        });

        $result = $this->orderBy($orderBy)->first($columns);
        if ($result) {
            return $result;
        }
        return null;
    }

    public function findOrFail($id, array $columns = ['*'])
    {
        return $this->getQueryBuilder()->findOrFail($id, $columns);
    }

    public function insert(array $data)
    {
        return $this->getQueryBuilder()->insert($data);
    }

    public function insertGetId(array $data)
    {
        return $this->getQueryBuilder()->insertGetId($data);
    }

    public function countWhere(array $conditions = [])
    {
        $this->getQueryBuilder();
        return $this->addCondition($conditions)->count();
    }

    public function count()
    {
        return $this->getQueryBuilder()->count();
    }

    public function update($attribute, $value, array $data)
    {
        return $this->getQueryBuilder()->where($attribute, '=', $value)->update($data);
    }

    public function updateById(int $id, array $data)
    {
        $model = $this->findOrFail($id);
        return $model->update($data) ? $model : false;
    }

    public function updateOrCreate($id, array $data)
    {
        return $this->getQueryBuilder()->updateOrCreate(['id' => $id], $data);
    }

    public function updateWhere(array $conditions, array $data)
    {
        $this->getQueryBuilder();
        return $this->addCondition($conditions)->update($data);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 1, array $columns = ['*'])
    {
        return $this->getQueryBuilder()->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->getQueryBuilder()->create($data);
    }

    public function createMulti(array $data)
    {
        return $this->getQueryBuilder()->insert($data);
    }

    public function delete($id)
    {
        return $this->getQueryBuilder()->where('id', '=', $id)->delete();
    }

    public function deleteWhere($attribute, $value)
    {
        return $this->getQueryBuilder()->where($attribute, '=', $value)->delete();
    }

    protected function orderBy(array $orderBys = [])
    {
        if (!empty($orderBys)) {
            foreach ($orderBys as $orderBy) {
                if (!$this->validateOrderBy($orderBy)) continue;
                list($attribute, $order) = $orderBy;
                $this->query->orderBy($attribute, $order);
            }
        }

        return $this->query;
    }

    /**
     * @param array $conditions
     * @return bool|mixed|null
     */
    protected function addCondition(array $conditions = [])
    {
        $this->validateCondition($conditions);

        foreach ($conditions as $value) {
            if ($value instanceof Closure) {
                $this->query->where($value);
                continue;
            }

            list($attribute, $operator, $val) = $value;

            if(is_null($val)) continue;

            switch ($operator) {
                case 'in':
                    $this->query->whereIn($attribute, $val);
                    break;
                case 'not in':
                    $this->query->whereNotIn($attribute, $val);
                    break;
                case 'has':
                    $this->query->whereHas($attribute, $val);
                    break;
                case 'doenst have':
                    $this->query->whereDoesntHave($attribute, $val);
                    break;
                case 'between':
                    $this->query->whereBetween($attribute, $val);
                    break;
                case 'not between':
                    $this->query->whereNotBetween($attribute, $val);
                    break;
                case 'is null':
                    $whereNullAction = (bool)$val ? 'whereNull' : 'whereNotNull';
                    $this->query->{$whereNullAction}($attribute);
                    break;
                default:
                    $this->query->where($attribute, $operator, $val);
            }
        }

        return $this->query;
    }

    /**
     * @param array $conditions
     * @return boolean
     */
    private function validateCondition(array $conditions = [])
    {
        if(!config('app.debug')){
            return true;
        }

        foreach ($conditions as $condition) {
            if($condition instanceof Closure) continue;

            if (count($condition) != 3 || !isset($condition[0]) || !isset($condition[1]) || (!isset($condition[2]) && !is_null($condition[2])) ) {
                die("Condition error");
            }

            list($attribute, $operator, $val) = $condition;

            if (!is_string($attribute) || !in_array($operator, $this->allowed_operator)) {
                die("Condition error");
            }

            if(!in_array($operator, $this->allowed_operator)){
                die("Operator {$val} not allow");
            }

            if($operator == 'is null' && !is_bool($val)){
                die("Input {$val} mus be type bool");
            }

            if(in_array($operator, ['in', 'not in', 'between', 'not between']) && !is_array($val) && !is_null($val)){
                die("Input {$val} mus be an array");
            }

            if(in_array($operator, ['has', 'doenst have']) && !($val instanceof Closure)){
                die("Input {$val} must be closure function");
            }
        }

        return true;
    }

    private function validateOrderBy(array $orderBy = [])
    {
        if(!config('app.debug')){
            return true;
        }

        if (!is_string($orderBy[0]) || !is_string($orderBy[1]) || !in_array($orderBy[1], $this->allowed_order)) {
            return false;
        }

        return true;
    }

}
