<?php
/**
 * 网站所有配置字段共享变量传递到模板中
 * User: jason
 * Date: 2018/9/15
 * Time: 上午10:19
 */

namespace App\ViewComposers;

use Cache;
use Illuminate\View\View;
use App\Repositories\Eloquent\ConfigRepository;

class AdminConfigComposer
{
    private $configRepository;

    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('config', $this->tranFormConfig());
    }

    private function tranFormConfig()
    {
        if (Cache::get('config')) {
            return Cache::get('config');
        } else {
            $data = $this->configRepository->getAll()->toArray();
            $info = [];
            foreach ($data as $value) {
                $info[$value['name']] = $value['value'];
            }
            Cache::forever('config', $info);

            return $info;
        }
    }
}