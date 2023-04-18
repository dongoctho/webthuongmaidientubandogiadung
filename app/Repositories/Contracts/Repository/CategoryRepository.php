<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Category;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getCategoryByCondition($condition, array $column = ['*'])
    {
        $query = $this->model->newQuery();
        $query->select($column)->where('categories.deleted_at', '=', null)->get();

        if (isset($condition['key'])) {
            $query->where('name', 'like', '%'.$condition['key'].'%')
                  ->orWhere('code', 'like', '%'.$condition['key'].'%')
                  ->get();
        }

        return $query->paginate(6);
    }
}
