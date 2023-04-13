<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230312200342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours (id_cours INT AUTO_INCREMENT NOT NULL, id_matiere_id INT NOT NULL, date_heure_cour_debut DATETIME DEFAULT NULL, date_heure_cour_fin DATETIME DEFAULT NULL, INDEX IDX_FDCA8C9C51E6528F (id_matiere_id), PRIMARY KEY(id_cours)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C51E6528F FOREIGN KEY (id_matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE calendrier DROP id, CHANGE id_calendrier id_calendrier INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_calendrier)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C51E6528F');
        $this->addSql('DROP TABLE cours');
        $this->addSql('ALTER TABLE calendrier MODIFY id_calendrier INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON calendrier');
        $this->addSql('ALTER TABLE calendrier ADD id INT NOT NULL, CHANGE id_calendrier id_calendrier INT NOT NULL');
    }
}
