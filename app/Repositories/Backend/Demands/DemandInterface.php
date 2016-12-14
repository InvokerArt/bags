<?php

namespace App\Repositories\Backend\Demands;

use App\Models\Demand;

interface DemandInterface
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
    public function update(Demand $demand, $input);
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

    /**
     * @param $input
     * @return mixed
     */
    public function search($input);

    /**
     * @param $input
     * @return mixed
     */
    public function searchWithUser($input);
}
