<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 新着情報ブロック（npsr_recent_news）をdtb_blockに追加
 */
final class Version20260306000002 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('dtb_block')) {
            return;
        }
        $exists = $this->connection->fetchOne("SELECT COUNT(*) FROM dtb_block WHERE file_name = 'npsr_recent_news'");
        if ($exists > 0) {
            return;
        }
        $this->addSql("INSERT INTO dtb_block (device_type_id, block_name, file_name, create_date, update_date, use_controller, deletable, discriminator_type) VALUES (10, '新着情報（一覧5件）', 'npsr_recent_news', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0', '1', 'block')");
    }

    public function down(Schema $schema): void
    {
        $id = $this->connection->fetchOne("SELECT id FROM dtb_block WHERE file_name = 'npsr_recent_news'");
        if ($id) {
            $this->addSql("DELETE FROM dtb_block_position WHERE block_id = " . (int) $id);
            $this->addSql("DELETE FROM dtb_block WHERE id = " . (int) $id);
        }
    }
}
