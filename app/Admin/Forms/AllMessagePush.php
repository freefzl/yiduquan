<?php

namespace App\Admin\Forms;

use App\Jobs\Message;
use App\Models\MessagePush;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class AllMessagePush extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '群发消息推送';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {


        dispatch(new Message($request->all()));

        admin_success('消息发送成功');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->hidden('class', '推送方式')->rules('required');
        $this->select('type', '消息类型')->options(MessagePush::$typeMap)->rules('required');
        $this->text('title', '标题')->rules('required');
        $this->editor('content', '内容')->rules('required');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            'type'       => 1,
            'class'       => 1,
            'title'      => '',
            'content' => '',
        ];
    }
}
