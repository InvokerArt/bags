<?php

namespace App\Repositories\Backend\Tags;

interface TagsInterface
{
    public function getAllTags($order_by = 'id', $sort = 'asc');

    public function getPopularTags($limit = 10);

    public function getForDataTable();

    public function create($input);

    public function update($input, $id);

    public function destroy($id);
}
