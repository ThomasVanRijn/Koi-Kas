<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200403090526 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blog_post (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, verhaal LONGTEXT NOT NULL, images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, string LONGTEXT NOT NULL, uri LONGTEXT NOT NULL, hoogte VARCHAR(255) NOT NULL, breedte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE karper (id INT AUTO_INCREMENT NOT NULL, soort_id INT NOT NULL, kweker_id INT NOT NULL, leeftijd_id INT NOT NULL, maat_id INT NOT NULL, naam VARCHAR(255) NOT NULL, image LONGTEXT DEFAULT NULL, prijs NUMERIC(10, 2) NOT NULL, INDEX IDX_44E58F723DEE50DF (soort_id), INDEX IDX_44E58F722CF3838D (kweker_id), INDEX IDX_44E58F72CFEDAEC0 (leeftijd_id), INDEX IDX_44E58F726DAA5BB0 (maat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kweker (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, zoek_naam VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leeftijd (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, zoek_naam VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maat (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, zoek_naam VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, naam VARCHAR(255) NOT NULL, prijs NUMERIC(10, 2) NOT NULL, beschrijving VARCHAR(255) DEFAULT NULL, image LONGTEXT NOT NULL, INDEX IDX_D34A04ADBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soort (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, zoek_naam VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F723DEE50DF FOREIGN KEY (soort_id) REFERENCES soort (id)');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F722CF3838D FOREIGN KEY (kweker_id) REFERENCES kweker (id)');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F72CFEDAEC0 FOREIGN KEY (leeftijd_id) REFERENCES leeftijd (id)');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F726DAA5BB0 FOREIGN KEY (maat_id) REFERENCES maat (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBCF5E72D');
        $this->addSql('ALTER TABLE karper DROP FOREIGN KEY FK_44E58F722CF3838D');
        $this->addSql('ALTER TABLE karper DROP FOREIGN KEY FK_44E58F72CFEDAEC0');
        $this->addSql('ALTER TABLE karper DROP FOREIGN KEY FK_44E58F726DAA5BB0');
        $this->addSql('ALTER TABLE karper DROP FOREIGN KEY FK_44E58F723DEE50DF');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE karper');
        $this->addSql('DROP TABLE kweker');
        $this->addSql('DROP TABLE leeftijd');
        $this->addSql('DROP TABLE maat');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE soort');
        $this->addSql('DROP TABLE user');
    }
}
