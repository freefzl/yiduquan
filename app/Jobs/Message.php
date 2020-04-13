<?php

namespace App\Jobs;

use App\Models\Member;
use App\Models\MessagePush;
use App\Models\Messages;
use App\Repositories\Members\MemberRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        dd($this->data['type']);
        switch ($this->data['type']) {
            case $this->data['type'] == MessagePush::TYPE_1:
                //系统消息
                if ($this->data['class'] == MessagePush::MYCLASS_1) {
                    $members = app(MemberRepository::class)->allValid();
                    foreach ($members as $member) {
                        $messagePush = new MessagePush();
                        $messagePush->member()->associate($member);
                        $messagePush->title = $this->data['title'];
                        $messagePush->content = $this->data['content'];
                        $messagePush->type = $this->data['type'];
                        $messagePush->class = $this->data['class'];
                        $messagePush->save();

                        $message = new Messages();
                        $message->member()->associate($member);
                        $message->title = $this->data['title'];
                        $message->content = $this->data['content'];
                        $message->type = $this->data['type'];
                        $message->save();
                    }
                }elseif ($this->data['class'] == MessagePush::MYCLASS_2) {
                    foreach ($this->data['ids'] as $id) {
                        if ($id) {
                            $member = Member::find($id);
                            if ($member) {
                                $messagePush = new MessagePush();
                                $messagePush->member()->associate($member);
                                $messagePush->title = $this->data['title'];
                                $messagePush->content = $this->data['content'];
                                $messagePush->type = $this->data['type'];
                                $messagePush->class = $this->data['class'];
                                $messagePush->save();

                                $message = new Messages();
                                $message->member()->associate($member);
                                $message->title = $this->data['title'];
                                $message->content = $this->data['content'];
                                $message->type = $this->data['type'];
                                $message->save();
                            }
                        }

                    }
                }




                break;
            case $this->data['type'] == MessagePush::TYPE_2:
                //短信消息
                break;
            case $this->data['type'] == MessagePush::TYPE_3:
                //公众号消息
                break;
        }
        file_put_contents(base_path('storage/').'queue_list',date('Y-m-d H:i:s',time())."队列数据：".json_encode($this->data).PHP_EOL,FILE_APPEND);
        /*$mess = new SendMessageController();
        $res = $mess->doSend($this->data['phone'],$this->data['event_id'],249345);
        if(!$res){
            file_put_contents(base_path('storage/').'queue_list',date('Y-m-d H:i:s',time())."队列数据：执行失败".PHP_EOL,FILE_APPEND);
        }
        \DB::table('events')->where('id',$this->data['event_id'])->update(['status'=>1]);
        file_put_contents(base_path('storage/').'queue_list',date('Y-m-d H:i:s',time())."队列数据：".json_encode($this->data).PHP_EOL,FILE_APPEND);*/

    }
}
