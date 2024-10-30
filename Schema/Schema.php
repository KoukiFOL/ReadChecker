<?php

namespace Kanboard\Plugin\ReadChecker\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec('
        CREATE TABLE IF NOT EXISTS check_log (
            id INT PRIMARY KEY AUTO_INCREMENT,
            task_id INT NOT NULL,
            user_id INT NOT NULL,
            checked_at DATETIME NOT NULL,
            FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )
    ');
}
