<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250403064442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE detail ADD master_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE detail ADD CONSTRAINT FK_2E067F9313B3DB11 FOREIGN KEY (master_id) REFERENCES master (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2E067F9313B3DB11 ON detail (master_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE detail DROP FOREIGN KEY FK_2E067F9313B3DB11
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_2E067F9313B3DB11 ON detail
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE detail DROP master_id
        SQL);
    }
}
