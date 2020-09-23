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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Addons\TemplatePaperCss\Constants\Constant;
use Addons\TemplatePaperCss\Commands\AppCommand;
use Addons\TemplatePaperCss\Http\Middlewares\InjectMiddleware;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 注册命令
        $this->commands([
            AppCommand::class,
        ]);
        // 注册视图
        $this->loadViewsFrom(__DIR__ . '/resources/views', Constant::APP_SIGN);

        Route::pushMiddlewareToGroup('web', InjectMiddleware::class);
    }

    public function register()
    {
    }
}
