<?php

namespace App\Repositories\Members;

use App\Models\Friends;
use App\Repositories\Abstracts\Repository;

class FriendsRepository extends Repository
{
    /**
     * 当前模块
     */
    public function model()
    {
        return Friends::class;
    }

    /**
     * 获取会员得所有好友
     * @param $key
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findByMid($mid)
    {
        $query = $this->newQuery();

        $query->where('mid', $mid);

        return $query->get();
    }
}