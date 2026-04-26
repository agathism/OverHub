<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260426194935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` CHANGE release_date release_date DATE NOT NULL COMMENT '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` RENAME INDEX idx_character_role TO IDX_937AB034D60322AC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy CHANGE content content LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy RENAME INDEX uniq_strategy_character TO UNIQ_144645ED18B21CEB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ultimate RENAME INDEX uniq_ultimate_character TO UNIQ_3FC79B0B18B21CEB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD password VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user RENAME INDEX uniq_user_email TO UNIQ_IDENTIFIER_EMAIL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE contact
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE newsletter
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` CHANGE release_date release_date DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` RENAME INDEX idx_937ab034d60322ac TO IDX_CHARACTER_ROLE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy CHANGE content content TEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE strategy RENAME INDEX uniq_144645ed18b21ceb TO UNIQ_STRATEGY_CHARACTER
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ultimate RENAME INDEX uniq_3fc79b0b18b21ceb TO UNIQ_ULTIMATE_CHARACTER
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP password
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user RENAME INDEX uniq_identifier_email TO UNIQ_USER_EMAIL
        SQL);
    }
}
