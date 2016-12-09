<?php

namespace App\Repositories\Backend\Faqs;

use App\Exceptions\GeneralException;
use App\Models\Company;
use App\Models\Faq;
use App\Models\User;
use App\Repositories\Backend\Notifications\NotificationInterface;
use DB;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class FaqRepository implements FaqInterface
{
    private $notification;

    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    public function getForDataTable()
    {
        return Faq::get();
    }

    public function create($input)
    {
        $faq = new Faq;
        $faq->title = $input['title'];
        $faq->content = $input['content'];

        DB::transaction(function () use ($faq, $input) {
            if ($faq->save()) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Faq $faq, $input)
    {
        $faq->title = $input['title'];
        $faq->content = $input['content'];

        DB::transaction(function () use ($faq) {
            if ($faq->update()) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);

        if ($faq->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }
}
