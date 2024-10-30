<h3>確認履歴</h3>
<ul>
<?php foreach ($this->checkLogModel->getTaskCheckLog($task['id']) as $log): ?>
    <li><?= $this->text->e($log['username']) ?> - <?= $this->dt->date($log['checked_at']) ?></li>
<?php endforeach ?>
</ul>
