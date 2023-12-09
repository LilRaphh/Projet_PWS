<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231209193017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier_vin DROP FOREIGN KEY FK_83987957BA62C651');
        $this->addSql('ALTER TABLE panier_vin DROP FOREIGN KEY FK_83987957F77D927C');
        $this->addSql('DROP TABLE panier_vin');
        $this->addSql('ALTER TABLE panier_qte ADD quantite INT NOT NULL');
        $this->addSql('ALTER TABLE vin ADD image_vin_size INT DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE imagesrc vin_image_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE panier_vin (panier_id INT NOT NULL, vin_id INT NOT NULL, INDEX IDX_83987957F77D927C (panier_id), INDEX IDX_83987957BA62C651 (vin_id), PRIMARY KEY(panier_id, vin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE panier_vin ADD CONSTRAINT FK_83987957BA62C651 FOREIGN KEY (vin_id) REFERENCES vin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_vin ADD CONSTRAINT FK_83987957F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_qte DROP quantite');
        $this->addSql('ALTER TABLE vin DROP image_vin_size, DROP updated_at, CHANGE vin_image_name imagesrc VARCHAR(255) DEFAULT NULL');
    }
}
