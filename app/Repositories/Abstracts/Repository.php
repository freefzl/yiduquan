<?php

namespace App\Repositories\Abstracts;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\RepositoryException;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    private $query;

    /**
     * 当前模型
     *
     * @var Model
     */
    protected $model;

    /**
     * 初始化
     *
     * @param Container $container
     * @throws RepositoryException
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->makeModel();
    }

    /**
     * 当前模型
     *
     * @return mixed
     */
    abstract function model();

    /**
     * 创建一个新查询
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        $this->query = $this->model->newQuery();
        return $this->query;
    }

    /**
     * 当前查询查询
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        if ($this->query) {
            return $this->query;
        }
        return $this->model->newQuery();
    }

    /**
     * 根据给定字段更新数据
     *
     * @param int $id 条件对应值
     * @param array $data 更新数据
     * @param string $attribute 条件字段
     * @return int
     */
    public function update($id, array $data, $attribute = 'id')
    {
        return $this->newQuery()->where($attribute, '=', $id)->update($data);
    }

    /**
     * 根据主键删除数据
     *
     * @param array|int  $ids
     * @return int
     */
    public function delete($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * 查询全部
     *
     * @param array $columns 查询字段
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = array('*'))
    {
        return $this->newQuery()->get($columns);
    }

    /**
     * 根据主键查找
     *
     * @param $id
     * @param array $columns
     * @return Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function find($id, $columns = array('*'))
    {
        return $this->newQuery()->find($id, $columns);
    }

    /**
     * 根据主键查找
     *
     * @param $id
     * @param array $columns
     * @return Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function findDeleted($id, $columns = array('*'))
    {
        return $this->newQuery()->onlyTrashed()->find($id, $columns);
    }

    /**
     * 根据字段查找
     *
     * @param string $attribute 字段
     * @param string $value 值
     * @param array $columns 查找字段
     * @return Model|static|null
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->newQuery()->where($attribute, '=', $value)->first($columns);
    }

    /**
     * 根据字段获取
     *
     * @param array $options
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBy($options = array(), $columns = array('*'))
    {
        $query = $this->newQuery();

        $query->where($options);

        return $query->get($columns);
    }

    /**
     * 分组查询
     *
     * @param $column
     * @return mixed
     */
    public function groupBy($column)
    {
        return $this->query()->groupBy($column);
    }

    /**
     * 分组查询
     *
     * @param string $columns
     * @return mixed
     */
    public function select($columns = '*')
    {
        return $this->query()->selectRaw($columns);
    }

    /**
     * 排序
     *
     * @param string $column
     * @param string $direction
     * @return mixed
     */
    public function orderBy($column, $direction = 'DESC')
    {
        return $this->query()->orderBy($column, $direction);
    }

    /**
     * 分页查询
     *
     * @param int|null $page 当前页码
     * @param int $perPage 最大分页
     * @param array $columns 查询字段
     * @param string $pageName 分页名称
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($page = null, $perPage = 15, $columns = array('*'), $pageName = 'page')
    {
        return $this->query()->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * 创建模块
     *
     * @return Model
     * @throws RepositoryException
     */
    protected function makeModel()
    {
        $model = $this->container->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("类 {$this->model()} 必须是 Illuminate\\Database\\Eloquent\\Model 的实例");
        }

        return $this->model = $model;
    }
}
