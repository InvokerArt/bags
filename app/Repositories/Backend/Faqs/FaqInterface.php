<?php

namespace App\Repositories\Backend\Faqs;

use App\Models\Faqs\Faq;

interface FaqInterface
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
    public function update(Faq $faq, $input);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);
}
