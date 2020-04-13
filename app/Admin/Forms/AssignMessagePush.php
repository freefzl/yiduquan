<?php

namespace App\Admin\Forms;

use App\Jobs\Message;
use App\Models\Member;
use App\Models\MessagePush;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class AssignMessagePush extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '指定消息推送';

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

        admin_success('Processed successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->hidden('class', '推送方式')->rules('required');
        $this->select('type', '消息类型')->options(MessagePush::$typeMap)->rules('required');
        $this->multipleSelect('ids', '指定收信人')->options(Member::all()->pluck('nickname','id'))->rules('required');
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
            'class'       => 2,
            'type'       => 1,
            'ids'      => [],
            'title' => '',
            'content' => '',
        ];
    }
}
