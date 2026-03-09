<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 旧 rankingsale カスタム実装の削除（有償プラグイン導入時の競合防止）
 */
final class Version20250306000000 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if ($schema->hasTable('dtb_plugin')) {
            $this->addSql("DELETE FROM dtb_plugin WHERE code = 'rankingsale'");
        }
        if ($schema->hasTable('dtb_block')) {
            $id = $this->connection->fetchOne("SELECT id FROM dtb_block WHERE file_name = 'rankingsale_block'");
            if ($id) {
                $this->addSql("DELETE FROM dtb_block_position WHERE block_id = " . (int) $id);
                $this->addSql("DELETE FROM dtb_block WHERE id = " . (int) $id);
            }
        }
        if ($schema->hasTable('plg_rankingsale')) {
            $this->addSql('DROP TABLE plg_rankingsale');
        }
    }

    public function down(Schema $schema): void
    {
        // ロールバック不要
    }
}
