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

use Illuminate\Support\ServiceProvider;
use Addons\TemplatePaperCss\Constants\Constant;
use Addons\TemplatePaperCss\Commands\AppCommand;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 注册命令
        $this->commands([
            AppCommand::class,
        ]);

        if ((int)config(Constant::CONFIG_PREFIX . '.status') === 1) {
            config(['meedu.systen.theme.path' => base_path('addons/TemplatePaperCss/resources/views')]);
        }
    }

    public function register()
    {
    }
}
