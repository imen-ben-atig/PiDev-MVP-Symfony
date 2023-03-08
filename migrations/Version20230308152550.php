<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308152550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640482EA2E54 FOREIGN KEY (commande_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_CE60640482EA2E54 ON reclamation (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640482EA2E54');
        $this->addSql('DROP INDEX IDX_CE60640482EA2E54 ON reclamation');
        $this->addSql('ALTER TABLE reclamation DROP commande_id');
    }
}
