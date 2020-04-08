<?php

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Vip extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Vip设置';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $file = $request->file();
        $imageName = '';
        if ($file) {
            $imageName = $file['image']->getClientOriginalName();

            upload_img($file['image']);
        }

        $vips = new \App\Models\Vip();
        $vip = $vips->orderBy('id', 'desc')->first();
        if ($vip) {
            $vip->annual_fee = $request->annual_fee;
            $vip->breaks = $request->breaks;
            $vip->image = $imageName ? 'images/' . $imageName : $vip->image;

        }else {
            $vip = new \App\Models\Vip();
            $vip->annual_fee = $request->annual_fee;
            $vip->breaks = $request->breaks;
            $vip->image = $imageName ? 'images/' . $imageName : $vip->image;
        }
        $vip->save();

        admin_success('Processed successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->decimal('annual_fee','年费')->rules('required');
        $this->decimal('breaks','减免')->rules('required');
        $this->image('image','福利图');


    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        $vips = new \App\Models\Vip();
        $vip = $vips->orderBy('id', 'desc')->first();
        if ($vip) {
            return [
                'annual_fee'       => $vip->annual_fee,
                'breaks'      => $vip->breaks,
                'image' => $vip->image,
            ];
        }
        return [
            'annual_fee'       => '',
            'breaks'      => '',
            'image' => '',
        ];
    }
}
