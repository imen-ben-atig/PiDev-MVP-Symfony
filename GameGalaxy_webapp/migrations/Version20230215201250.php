<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215201250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, titre_rec VARCHAR(255) NOT NULL, type_rec VARCHAR(255) NOT NULL, date_rec DATE NOT NULL, contenu_rec LONGTEXT NOT NULL, statut_rec INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repons (id INT AUTO_INCREMENT NOT NULL, id_reclamation_id INT DEFAULT NULL, date_rep DATE NOT NULL, contenu_rep LONGTEXT NOT NULL, status_rep INT NOT NULL, UNIQUE INDEX UNIQ_BC3CBF7A100D1FDF (id_reclamation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE repons ADD CONSTRAINT FK_BC3CBF7A100D1FDF FOREIGN KEY (id_reclamation_id) REFERENCES reclamation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repons DROP FOREIGN KEY FK_BC3CBF7A100D1FDF');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE repons');
    }
}
