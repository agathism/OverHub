<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250511180207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034D60322AC
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE roles
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034D60322AC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` ADD CONSTRAINT FK_937AB034D60322AC FOREIGN KEY (role_id) REFERENCES role (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034D60322AC
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE role
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034D60322AC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` ADD CONSTRAINT FK_937AB034D60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
    }
}
