<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250508145746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE ability (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, occupation VARCHAR(255) NOT NULL, release_date DATE NOT NULL COMMENT '(DC2Type:date_immutable)', description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE lore (id INT AUTO_INCREMENT NOT NULL, name_id INT DEFAULT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_33EE951971179CD6 (name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lore ADD CONSTRAINT FK_33EE951971179CD6 FOREIGN KEY (name_id) REFERENCES `character` (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE lore DROP FOREIGN KEY FK_33EE951971179CD6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ability
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `character`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lore
        SQL);
    }
}
