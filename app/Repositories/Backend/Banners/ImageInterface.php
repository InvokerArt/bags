<?php

namespace App\Repositories\Backend\Banners;

use App\Models\Banners\Image;

interface ImageInterface
{
    //获取所有轮播图
    public function getAll();

    public function getForDataTable();

    //根据分类获取轮播图
    public function getCategoryBanners($id);

    /**
     * @param  $input
     * @return mixed
     */
    public function create($input);

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update(Image $image, $input);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);
    
    /**
     * @param  $id
     * @return mixed
     */
    public function restore($id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
