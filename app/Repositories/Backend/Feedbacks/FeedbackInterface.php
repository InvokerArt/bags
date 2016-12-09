<?php

namespace App\Repositories\Backend\Feedbacks;

use App\Models\Feedback;

interface FeedbackInterface
{
    public function getForDataTable();

    /**
     * @param  $input
     * @return mixed
     */
    public function create($input);

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id);
}
