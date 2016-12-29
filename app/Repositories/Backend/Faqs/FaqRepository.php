<?php

namespace App\Repositories\Backend\Faqs;

use App\Exceptions\GeneralException;
use App\Models\Company;
use App\Models\Faq;
use App\Models\User;
use App\Repositories\Backend\Notifications\NotificationRepository;
use DB;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class FaqRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Faq::class;

    private $notification;

    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    public function getForDataTable()
    {
        return $this->query()->get();
    }

    public function create($input)
    {
        $faq = self::MODEL;
        $faq = new $faq;
        $faq->title = $input['title'];
        $faq->content = $input['content'];

        DB::transaction(function () use ($faq) {
            if (parent::save($faq)) {
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $faq, array $input)
    {
        DB::transaction(function () use ($faq, $input) {
            if (parent::update($faq, $input)) {
                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $faq)
    {
        if (parent::delete($faq)) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function index()
    {
        return $this->query()->orderBy('created_at', 'DESC')->paginate();
    }
}
