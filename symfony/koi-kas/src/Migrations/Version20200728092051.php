<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728092051 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE karper (id INT AUTO_INCREMENT NOT NULL, soort_id INT NOT NULL, kweker_id INT NOT NULL, naam VARCHAR(255) NOT NULL, image LONGTEXT DEFAULT NULL, prijs DOUBLE PRECISION NOT NULL, maat DOUBLE PRECISION NOT NULL, INDEX IDX_44E58F723DEE50DF (soort_id), INDEX IDX_44E58F722CF3838D (kweker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leeftijd (id INT AUTO_INCREMENT NOT NULL, naam INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maat (id INT AUTO_INCREMENT NOT NULL, naam DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F723DEE50DF FOREIGN KEY (soort_id) REFERENCES soort (id)');
        $this->addSql('ALTER TABLE karper ADD CONSTRAINT FK_44E58F722CF3838D FOREIGN KEY (kweker_id) REFERENCES kweker (id)');
        $this->addSql('ALTER TABLE blog_image CHANGE file file VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_post CHANGE verhaal verhaal LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE image CHANGE string string LONGTEXT NOT NULL, CHANGE uri uri LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE beschrijving beschrijving VARCHAR(255) DEFAULT NULL, CHANGE image image LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE karper');
        $this->addSql('DROP TABLE leeftijd');
        $this->addSql('DROP TABLE maat');
        $this->addSql('ALTER TABLE blog_image CHANGE file file VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE blog_post CHANGE verhaal verhaal LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE image CHANGE string string LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE uri uri LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE beschrijving beschrijving VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE image image LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
