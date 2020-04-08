<?php

namespace App\Admin\Forms;


use App\Repositories\Settings\SettingRepository;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class PlatformRules extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '平台规则';

    protected $platform_rules = 'platform_rules';
    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {


        $key = $request->get('key');
        $val = $request->get('val');

        $SettingRepo = app(SettingRepository::class);
        $setting = $SettingRepo->findByKey($this->platform_rules);

        if ($setting) {
            $setting->key = $key;
            $setting->val = $val;
        }else {
            $setting = new \App\Models\Setting();
            $setting->key = $key;
            $setting->val = $val;
        }
        $setting->save();

        admin_success('Processed successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->hidden('key', '字段名')->rules('required');
        $this->editor('val', '平台规则')->rules('required');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {

        $SettingRepo = app(SettingRepository::class);
        $setting = $SettingRepo->findByKey($this->platform_rules);
        if ($setting) {
            return [
                'key'       => $this->platform_rules,
                'val'       => $setting->val ? $setting->val : '平台规则内容',
            ];
        }
        return [
            'key'       => $this->platform_rules,
            'val'       => '平台规则内容',
        ];
    }
}
