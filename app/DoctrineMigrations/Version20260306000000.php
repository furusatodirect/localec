<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * 新着情報一覧・詳細ページをdtb_pageに追加
 * 4.1のページ管理で存在していたNewsページを4.3に移行
 */
final class Version20260306000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add news_index and news_detail pages to dtb_page';
    }

    public function up(Schema $schema): void
    {
        $count = $this->connection->fetchOne("SELECT COUNT(*) FROM dtb_page WHERE url = 'news_index'");
        if ($count > 0) {
            return;
        }

        $pageId = (int) $this->connection->fetchOne('SELECT COALESCE(MAX(id), 0) FROM dtb_page');
        $sortNo = (int) $this->connection->fetchOne('SELECT COALESCE(MAX(sort_no), 0) FROM dtb_page_layout');

        $now = date('Y-m-d H:i:s');

        // 新着情報一覧
        $pageId++;
        $this->addSql("INSERT INTO dtb_page (
            id, master_page_id, page_name, url, file_name, edit_type, create_date, update_date, meta_robots, discriminator_type
        ) VALUES (
            {$pageId}, NULL, '新着情報一覧', 'news_index', 'News/index', 2, '{$now}', '{$now}', NULL, 'page'
        )");
        $sortNo++;
        $this->addSql("INSERT INTO dtb_page_layout (page_id, layout_id, sort_no, discriminator_type) VALUES ({$pageId}, 2, {$sortNo}, 'pagelayout')");

        // 新着情報詳細
        $pageId++;
        $this->addSql("INSERT INTO dtb_page (
            id, master_page_id, page_name, url, file_name, edit_type, create_date, update_date, meta_robots, discriminator_type
        ) VALUES (
            {$pageId}, NULL, '新着情報詳細', 'news_detail', 'News/detail', 2, '{$now}', '{$now}', NULL, 'page'
        )");
        $sortNo++;
        $this->addSql("INSERT INTO dtb_page_layout (page_id, layout_id, sort_no, discriminator_type) VALUES ({$pageId}, 2, {$sortNo}, 'pagelayout')");

        if ($this->platform->getName() === 'postgresql') {
            $this->addSql("SELECT setval('dtb_page_id_seq', {$pageId})");
        }
    }

    public function down(Schema $schema): void
    {
        $rows = $this->connection->fetchAllAssociative("SELECT id FROM dtb_page WHERE url IN ('news_index', 'news_detail')");
        if (!empty($rows)) {
            $ids = array_column($rows, 'id');
            $idList = implode(',', array_map('intval', $ids));
            $this->addSql("DELETE FROM dtb_page_layout WHERE page_id IN ({$idList})");
            $this->addSql("DELETE FROM dtb_page WHERE id IN ({$idList})");
        }
    }
}