<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251205190833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE environnement (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visite CHANGE pays pays VARCHAR(50) NOT NULL, CHANGE datecreation datecreation DATETIME NOT NULL, CHANGE note note INT NOT NULL, CHANGE avis avis LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE environnement');
        $this->addSql('ALTER TABLE visite CHANGE pays pays VARCHAR(100) DEFAULT NULL, CHANGE note note INT DEFAULT NULL, CHANGE datecreation datecreation DATETIME DEFAULT NULL, CHANGE avis avis TEXT DEFAULT NULL');
    }
}
