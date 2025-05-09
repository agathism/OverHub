<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509134837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` ADD role_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` ADD CONSTRAINT FK_937AB034D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_937AB034D60322AC ON `character` (role_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034D60322AC
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_937AB034D60322AC ON `character`
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `character` DROP role_id
        SQL);
    }
}
