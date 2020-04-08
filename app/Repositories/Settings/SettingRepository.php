<?php

namespace App\Repositories\Settings;

use App\Models\Setting;
use App\Repositories\Abstracts\Repository;

class SettingRepository extends Repository
{
    /**
     * 当前模块
     */
    public function model()
    {
        return Setting::class;
    }

    /**
     * 根据key获取数据
     * @param $key
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findByKey($key)
    {
        $query = $this->newQuery();

        $query->where('key', $key);

        $query->orderBy('id', 'desc');

        return $query->first();
    }
}