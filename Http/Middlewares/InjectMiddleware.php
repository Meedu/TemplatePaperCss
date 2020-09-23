<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Addons\TemplatePaperCss\Http\Middlewares;

use Illuminate\Http\Request;
use Addons\TemplatePaperCss\Constants\Constant;

class InjectMiddleware
{

    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (!is_h5() && (int)config(Constant::CONFIG_PREFIX . '.status') === 1) {
            config(['meedu.system.theme.use' => Constant::APP_SIGN]);
        }

        return $next($request);
    }
}
