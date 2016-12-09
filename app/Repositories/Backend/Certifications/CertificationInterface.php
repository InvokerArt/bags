<?php

namespace App\Repositories\Backend\Certifications;

use App\Models\Certification;

interface CertificationInterface
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
    public function update(Certification $certification, $input);

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
