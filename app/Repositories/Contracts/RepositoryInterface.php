<?php

namespace App\Repositories\Contracts;

interface  RepositoryInterface
{
    /**
     * 创建新查询
     */
    public function newQuery();

    /**
     * 当前查询组合
     */
    public function query();

    /**
     * 创建数据
     *
     * @param int $id 主键Id
     * @param array $data 数据
     */
    public function update($id, array $data);

    /**
     * 删除数据
     *
     * @param int $id 主键Id
     * @return void
     */
    public function delete($id);

    /**
     * 查询全部
     *
     * @param array $columns 列选项
     */
    public function all($columns = array('*'));

    /**
     * 根据主键查询数据
     *
     * @param int $id 主键Id
     * @param array $columns 列选项
     */
    public function find($id, $columns = array('*'));

    /**
     * 根据主键查询数据
     *
     * @param string $field 查找字段
     * @param string $value 查找值
     * @param array $columns 列选项
     */
    public function findBy($field, $value, $columns = array('*'));

    /**
     * 分页查询
     *
     * @param int|null $page 当前页码
     * @param int $perPage 最大分页
     * @param array $columns 列选项
     * @param string $pageName 分页名称
     */
    public function paginate($page = null, $perPage = 15, $columns = array('*'), $pageName = 'page');
}