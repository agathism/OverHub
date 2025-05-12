<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250512142805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE ultimate DROP FOREIGN KEY FK_3FC79B0B81877935
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_3FC79B0B81877935 ON ultimate
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ultimate CHANGE character_id_id character_name_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ultimate ADD CONSTRAINT FK_3FC79B0B18B21CEB FOREIGN KEY (character_name_id) REFERENCES `character` (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_3FC79B0B18B21CEB ON ultimate (character_name_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE ultimate DROP FOREIGN KEY FK_3FC79B0B18B21CEB
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_3FC79B0B18B21CEB ON ultimate
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ultimate CHANGE character_name_id character_id_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ultimate ADD CONSTRAINT FK_3FC79B0B81877935 FOREIGN KEY (character_id_id) REFERENCES `character` (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_3FC79B0B81877935 ON ultimate (character_id_id)
        SQL);
    }
}
