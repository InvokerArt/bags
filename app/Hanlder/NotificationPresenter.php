<?php

namespace App\Hanlder;

trait NotificationPresenter
{
    public function subject()
    {
        switch ($this->action) {
            case 'new_reply':
                $subject = trans('notification.New reply subject');
                break;
            case 'topic_vote':
                $subject = trans('notification.Topic vote subject');
                break;
            case 'reply_vote':
                $subject = trans('notification.Reply vote subject');
                break;
            case 'join_company':
                $subject = trans('notification.Join company subject');
                break;
            case 'certification_company':
                $subject = trans('notification.Certification company subject');
                break;
            default:
                break;
        }
        return $subject;
    }

    public function lableUp()
    {
        switch ($this->action) {
            case 'new_reply':
                $lable = trans('notification.Your topic have new reply');
                break;
            case 'topic_vote':
                $lable = trans('notification.Up Vote your topic');
                break;
            case 'reply_vote':
                $lable = trans('notification.Up Vote your reply');
                break;
            case 'join_company':
                $lable = trans('notification.Your company has new user application join');
                break;
            case 'certification_company':
                $lable = trans('notification.Your company has new user application certification');
                break;
            case 'follow':
                $lable = trans('notification.Someone following you');
                break;
            default:
                break;
        }
        return $lable;
    }
}
