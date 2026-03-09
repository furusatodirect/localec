<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 旧 rankingsale カスタム実装の追加（取りやめ・空実装）
 * 有償プラグインで対応するため、本マイグレーションは何も行わない
 */
final class Version20250305000000 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // 取りやめ：何も追加しない
    }

    public function down(Schema $schema): void
    {
    }
}
