<?php

namespace Kanboard\Plugin\ReadChecker\Model;

use Kanboard\Core\Base;

class CheckLogModel extends Base
{
    const TABLE = 'check_log';

    // タスク確認のログを挿入するメソッド
    public function logTaskCheck($task_id, $user_id)
    {
        // 重複チェック（同じタスクとユーザーが同じ時間内に複数回記録されないように）
        $exists = $this->db->table(self::TABLE)->eq('task_id', $task_id)->eq('user_id', $user_id)->exists();
        
        if (!$exists) {
            $this->db->table(self::TABLE)->insert([
                'task_id'    => $task_id,
                'user_id'    => $user_id,
                'checked_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    // タスク確認ログを取得するメソッド
    public function getTaskCheckLog($task_id)
    {
        return $this->db->table(self::TABLE)
            ->columns('users.username', 'check_log.checked_at')
            ->join('users', 'id', 'user_id')
            ->eq('task_id', $task_id)
            ->findAll();
    }
}
