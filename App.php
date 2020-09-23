<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Addons\TemplatePaperCss;

use App\Meedu\MeEdu;
use Illuminate\Support\Arr;
use App\Services\Base\Model\AppConfig;
use Addons\TemplatePaperCss\Constants\Constant;

class App
{
    const CONFIG_ITEMS = [
        [
            'group' => 'PaperCss主题',
            'name' => '开启',
            'field_type' => 'switch',
            'sort' => 0,
            'key' => Constant::CONFIG_PREFIX . '.status',
            'value' => 0,
        ],
    ];

    public static function install()
    {
        self::configInstall();
    }

    public static function uninstall()
    {
        self::configUninstall();
    }

    protected static function configInstall()
    {
        if (!version_compare(MeEdu::VERSION, 'v3.2', '>=')) {
            return;
        }

        $localConfig = [];
        $localConfigFile = storage_path('meedu_config.json');
        if (file_exists($localConfigFile)) {
            $localConfig = json_decode(file_get_contents($localConfigFile), true);
        }

        foreach (self::CONFIG_ITEMS as $item) {
            $key = $item['key'];
            $item['value'] = Arr::get($localConfig, $key, $item['value']);
            if (!AppConfig::query()->where('key', $key)->exists()) {
                AppConfig::create($item);
            }
        }
    }

    protected static function configUninstall()
    {
        if (!version_compare(MeEdu::VERSION, 'v3.2', '>=')) {
            return;
        }

        foreach (self::CONFIG_ITEMS as $item) {
            AppConfig::query()->where('key', $item['key'])->delete();
        }
    }
}
