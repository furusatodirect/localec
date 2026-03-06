<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Newsページをuser_data経由にしないためedit_typeを変更
 * 正しいURL: /news, /news/{id}
 */
final class Version20260306000001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change news pages edit_type to prevent user_data URL';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("UPDATE dtb_page SET edit_type = 2 WHERE url IN ('news_index', 'news_detail')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("UPDATE dtb_page SET edit_type = 0 WHERE url IN ('news_index', 'news_detail')");
    }
}
