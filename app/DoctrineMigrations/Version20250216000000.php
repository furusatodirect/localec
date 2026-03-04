<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 性別の表示順を「回答しない」→「男性」→「女性」→「その他」に変更
 */
final class Version20250216000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update mtb_sex sort_no: 回答しない(0), 男性(1), 女性(2), その他(3)';
    }

    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('mtb_sex')) {
            return;
        }

        $this->addSql('UPDATE mtb_sex SET sort_no = 0 WHERE id = 4');
        $this->addSql('UPDATE mtb_sex SET sort_no = 1 WHERE id = 1');
        $this->addSql('UPDATE mtb_sex SET sort_no = 2 WHERE id = 2');
        $this->addSql('UPDATE mtb_sex SET sort_no = 3 WHERE id = 3');
    }

    public function down(Schema $schema): void
    {
        if (!$schema->hasTable('mtb_sex')) {
            return;
        }

        $this->addSql('UPDATE mtb_sex SET sort_no = 0 WHERE id = 1');
        $this->addSql('UPDATE mtb_sex SET sort_no = 1 WHERE id = 2');
        $this->addSql('UPDATE mtb_sex SET sort_no = 2 WHERE id = 3');
        $this->addSql('UPDATE mtb_sex SET sort_no = 3 WHERE id = 4');
    }
}
