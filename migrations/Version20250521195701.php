<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250521195701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contact CHANGE message message LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy DROP FOREIGN KEY FK_144645ED71179CD6
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_144645ED71179CD6 ON strategy
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy CHANGE name_id character_name_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy ADD CONSTRAINT FK_144645ED18B21CEB FOREIGN KEY (character_name_id) REFERENCES `character` (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_144645ED18B21CEB ON strategy (character_name_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy DROP FOREIGN KEY FK_144645ED18B21CEB
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_144645ED18B21CEB ON strategy
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy CHANGE character_name_id name_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy ADD CONSTRAINT FK_144645ED71179CD6 FOREIGN KEY (name_id) REFERENCES `character` (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_144645ED71179CD6 ON strategy (name_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contact CHANGE message message VARCHAR(255) NOT NULL
        SQL);
    }
}
