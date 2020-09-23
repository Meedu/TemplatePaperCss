<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Addons\TemplatePaperCss\Commands;

use Illuminate\Console\Command;
use Addons\TemplatePaperCss\App;
use Illuminate\Filesystem\Filesystem;

class AppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TemplatePaperCss {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    protected $file;

    /**
     * AppCommand constructor.
     * @param Filesystem $file
     */
    public function __construct(Filesystem $file)
    {
        parent::__construct();
        $this->file = $file;
    }

    public function handle()
    {
        $action = $this->argument('action');
        $method = 'action' . ucfirst($action);
        $this->{$method}();
    }

    protected function actionInstall()
    {
        App::install();

        // public目录软链接
        @unlink(base_path('public/addons/TemplatePaperCss'));
        $this->file->link(base_path('addons/TemplatePaperCss/public'), base_path('public/addons/TemplatePaperCss'));
    }

    protected function actionUninstall()
    {
        App::uninstall();

        // public目录软链接
        @unlink(base_path('public/addons/TemplatePaperCss'));
    }

    protected function actionUpgrade()
    {
        App::install();

        // public目录软链接
        @unlink(base_path('public/addons/TemplatePaperCss'));
        $this->file->link(base_path('addons/TemplatePaperCss/public'), base_path('public/addons/TemplatePaperCss'));
    }
}
