<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230220200217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation ADD username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE repons ADD contenu_rep LONGTEXT NOT NULL, DROP relation, CHANGE id_reclamation_id id_reclamation_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP username');
        $this->addSql('ALTER TABLE repons ADD relation VARCHAR(255) NOT NULL, DROP contenu_rep, CHANGE id_reclamation_id id_reclamation_id INT NOT NULL');
    }
}
