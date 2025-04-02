<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250402165914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE film ADD genre_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE film ADD CONSTRAINT FK_8244BE224296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8244BE224296D31F ON film (genre_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE film DROP FOREIGN KEY FK_8244BE224296D31F
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8244BE224296D31F ON film
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE film DROP genre_id
        SQL);
    }
}
