<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogPostRepository
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * get list of blog
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        $fields = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this
            ->startConditions()
            ->select($fields)
            ->orderBy('id', 'DESC')
            //->with(['category', 'user'])
            ->with([
                'user:id,name',
                'category:id,title',
            ])
            ->paginate(25);

        return $result;
    }

    /**
     * get model for editing in the admin panel
     * @param $id
     * @return Model
     */
    public function getEdit($id){
        return $this->startConditions()->find($id);
    }
}
