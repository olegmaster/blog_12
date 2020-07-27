<?php


namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;


class BlogCategoryRepository extends CoreRepository
{
    /**
     * @param $id
     * @return
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * @return mixed
     */
    public function getForComboBox()
    {
        $columns = implode(', ', [
            'id',
            'CONCAT(id, ". ", title) AS id_title'
        ]);
        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * @param int|null $pageSize
     * @return mixed
     */
    public function getAllWithPaginate($pageSize = null)
    {
        $fields = ['id', 'title', 'parent_id'];

        return $this->startConditions()
            ->select($fields)
            ->paginate($pageSize);
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
