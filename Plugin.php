<?php

namespace Kanboard\Plugin\ReadChecker;

use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\ReadChecker\Model\CheckLogModel;

class Plugin extends Base
{
    public function initialize()
    {
        // タスクの詳細画面が表示されるたびにフック
        $this->hook->on('template:task:show:after', function(array $data) {
            $this->container['checkLogModel']->logTaskCheck($data['task']['id'], $this->userSession->getId());
        });

        // タスク詳細画面に確認ログを表示するカスタムテンプレートを読み込み
        $this->template->hook->attach('template:task:show:bottom', 'readchecker:task/check_log');
    }

    public function onStartup()
    {
        $this->container['checkLogModel'] = $this->container->factory(CheckLogModel::class);
    }

    public function getPluginName()
    {
        return 'ReadChecker';
    }

    public function getPluginDescription()
    {
        return 'Log when users check tasks and display the information.';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.0';
    }

    public function getPluginAuthor()
    {
        return 'UEYAMA Koki';
    }

    public function getPluginHomepage()
    {
        return 'None';
    }
}
