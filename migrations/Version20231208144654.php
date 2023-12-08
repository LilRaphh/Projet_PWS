<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231208144654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_24CC0DF2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier_vin (panier_id INT NOT NULL, vin_id INT NOT NULL, INDEX IDX_83987957F77D927C (panier_id), INDEX IDX_83987957BA62C651 (vin_id), PRIMARY KEY(panier_id, vin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recrutement (id INT AUTO_INCREMENT NOT NULL, cv_id INT DEFAULT NULL, lettre_motiv_id INT DEFAULT NULL, INDEX IDX_25EB2319CFE419E2 (cv_id), INDEX IDX_25EB23195CD93873 (lettre_motiv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE panier_vin ADD CONSTRAINT FK_83987957F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_vin ADD CONSTRAINT FK_83987957BA62C651 FOREIGN KEY (vin_id) REFERENCES vin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recrutement ADD CONSTRAINT FK_25EB2319CFE419E2 FOREIGN KEY (cv_id) REFERENCES recrutement (id)');
        $this->addSql('ALTER TABLE recrutement ADD CONSTRAINT FK_25EB23195CD93873 FOREIGN KEY (lettre_motiv_id) REFERENCES recrutement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('ALTER TABLE panier_vin DROP FOREIGN KEY FK_83987957F77D927C');
        $this->addSql('ALTER TABLE panier_vin DROP FOREIGN KEY FK_83987957BA62C651');
        $this->addSql('ALTER TABLE recrutement DROP FOREIGN KEY FK_25EB2319CFE419E2');
        $this->addSql('ALTER TABLE recrutement DROP FOREIGN KEY FK_25EB23195CD93873');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE panier_vin');
        $this->addSql('DROP TABLE recrutement');
    }
}
