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
use App\Models\AdministratorMenu;
use App\Services\Base\Model\AppConfig;
use Addons\TemplatePaperCss\Constants\Constant;

class App
{
    const PERMISSIONS = [];

    const MENUS = [];

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
        self::permissionsInstall();
        self::menuInstall();
        self::configInstall();
    }

    public static function uninstall()
    {
        self::permissionsUninstall();
        self::menuUninstall();
        self::configUninstall();
    }

    public static function permissionsInstall()
    {
        if (!version_compare(MeEdu::VERSION, 'v3.2', '>=')) {
            return;
        }
        foreach (self::PERMISSIONS as $permission) {
            $exists = \App\Models\AdministratorPermission::where('slug', $permission['slug'])
                ->where('method', $permission['method'])
                ->exists();
            if ($exists) {
                continue;
            }
            \App\Models\AdministratorPermission::create([
                'display_name' => $permission['display_name'],
                'group_name' => $permission['group_name'],
                'slug' => $permission['slug'],
                'description' => $permission['description'] ?? '',
                'method' => $permission['method'],
                'url' => $permission['url'],
                'route' => $permission['route'] ?? '',
            ]);
        }
    }

    public static function permissionsUninstall()
    {
        foreach (self::PERMISSIONS as $permission) {
            \App\Models\AdministratorPermission::where('slug', $permission['slug'])->where('method', $permission['method'])->delete();
        }
    }

    public static function menuInstall()
    {
        if (!version_compare(MeEdu::VERSION, 'v3.2', '>=')) {
            return;
        }
        $sort = AdministratorMenu::query()->where('parent_id', 0)->max('sort');
        $sort += 100;
        foreach (self::MENUS as $index => $menu) {
            $sort += $index;
            $parent = AdministratorMenu::query()->where('name', $menu['title'])->where('url', $menu['key'])->first();
            if (!$parent) {
                // 创建
                $parent = AdministratorMenu::create([
                    'parent_id' => 0,
                    'name' => $menu['title'],
                    'url' => $menu['key'] ?? '',
                    'permission' => $menu['permission'] ?? '',
                    'icon' => $menu['icon'] ?? '',
                    'is_super' => $menu['super'] ?? 0,
                    'sort' => $sort,
                ]);
            }

            $children = $menu['children'] ?? [];
            if (!$children) {
                continue;
            }

            foreach ($children as $i => $item) {
                $childSort = $sort + ($i + 1) * 10;
                if (AdministratorMenu::query()->where('name', $item['title'])->where('url', $item['key'])->exists()) {
                    continue;
                }
                AdministratorMenu::create([
                    'parent_id' => $parent['id'],
                    'name' => $item['title'],
                    'url' => $item['key'] ?? '',
                    'permission' => $item['permission'] ?? '',
                    'icon' => $item['icon'] ?? '',
                    'is_super' => $item['super'] ?? 0,
                    'sort' => $childSort,
                ]);
            }
        }
    }

    public static function menuUninstall()
    {
        foreach (self::MENUS as $menu) {
            AdministratorMenu::query()->where('name', $menu['title'])->where('url', $menu['key'])->delete();
            $children = $menu['children'] ?? [];
            if (!$children) {
                continue;
            }
            foreach ($children as $item) {
                AdministratorMenu::query()->where('name', $item['title'])->where('url', $item['key'])->delete();
            }
        }
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
