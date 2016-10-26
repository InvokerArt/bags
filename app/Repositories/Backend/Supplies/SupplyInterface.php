<?php

namespace App\Repositories\Backend\Supplies;

use App\Models\Supplies\Supply;

interface SupplyInterface
{
    public function getForDataTable();

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
    public function update(Supply $supply, $input);
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
