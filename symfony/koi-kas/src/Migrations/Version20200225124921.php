<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225124921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE verhaal verhaal LONGTEXT NOT NULL, CHANGE images images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE categorie CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE image CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE uri uri LONGTEXT NOT NULL, CHANGE string string LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE karper CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE image image LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F723DEE50DF FOREIGN KEY (soort_id) REFERENCES soort (id)');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F722CF3838D FOREIGN KEY (kweker_id) REFERENCES kweker (id)');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F72CFEDAEC0 FOREIGN KEY (leeftijd_id) REFERENCES leeftijd (id)');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F726DAA5BB0 FOREIGN KEY (maat_id) REFERENCES maat (id)');
        $this->addSql('ALTER TABLE kweker CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE zoek_naam zoek_naam VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE leeftijd CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE zoek_naam zoek_naam VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE maat CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE zoek_naam zoek_naam VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE beschrijving beschrijving VARCHAR(255) DEFAULT NULL, CHANGE image image LONGTEXT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADBCF5E72D ON product (categorie_id)');
        $this->addSql('ALTER TABLE soort CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE zoek_naam zoek_naam VARCHAR(255) DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user ADD password VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE roles roles JSON NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post CHANGE id id INT NOT NULL, CHANGE verhaal verhaal LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE images images LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE categorie CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE image CHANGE id id INT NOT NULL, CHANGE string string LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE uri uri LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE karper DROP FOREIGN KEY FK_44E58F723DEE50DF');
        $this->addSql('ALTER TABLE karper DROP FOREIGN KEY FK_44E58F722CF3838D');
        $this->addSql('ALTER TABLE karper DROP FOREIGN KEY FK_44E58F72CFEDAEC0');
        $this->addSql('ALTER TABLE karper DROP FOREIGN KEY FK_44E58F726DAA5BB0');
        $this->addSql('ALTER TABLE karper CHANGE id id INT NOT NULL, CHANGE image image LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE kweker CHANGE id id INT NOT NULL, CHANGE zoek_naam zoek_naam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE leeftijd CHANGE id id INT NOT NULL, CHANGE zoek_naam zoek_naam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE maat CHANGE id id INT NOT NULL, CHANGE zoek_naam zoek_naam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBCF5E72D');
        $this->addSql('DROP INDEX IDX_D34A04ADBCF5E72D ON product');
        $this->addSql('ALTER TABLE product DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE product CHANGE id id INT NOT NULL, CHANGE beschrijving beschrijving VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE image image LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE soort MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE soort DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE soort CHANGE id id INT NOT NULL, CHANGE zoek_naam zoek_naam VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user DROP password, CHANGE id id INT NOT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
