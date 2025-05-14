<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514083942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE strategy (id INT AUTO_INCREMENT NOT NULL, name_id INT DEFAULT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_144645ED71179CD6 (name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy ADD CONSTRAINT FK_144645ED71179CD6 FOREIGN KEY (name_id) REFERENCES `character` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lore DROP FOREIGN KEY FK_33EE951971179CD6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lore
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE profile
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE lore (id INT AUTO_INCREMENT NOT NULL, name_id INT DEFAULT NULL, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_33EE951971179CD6 (name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lore ADD CONSTRAINT FK_33EE951971179CD6 FOREIGN KEY (name_id) REFERENCES `character` (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy DROP FOREIGN KEY FK_144645ED71179CD6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE strategy
        SQL);
    }
}
