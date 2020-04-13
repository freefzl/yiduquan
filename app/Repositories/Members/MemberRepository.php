<?php

namespace App\Repositories\Members;

use App\Models\Friends;
use App\Models\Member;
use App\Repositories\Abstracts\Repository;

class MemberRepository extends Repository
{
    /**
     * 当前模块
     */
    public function model()
    {
        return Member::class;
    }

    /**
     * 获取有效会员
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allValid()
    {
        $query = $this->newQuery();

        $query->where('status', 1);

        $query->whereNull('deleted_at');

        return $query->get();
    }
}