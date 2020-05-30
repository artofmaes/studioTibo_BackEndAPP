<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526130102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, cat_name VARCHAR(255) NOT NULL, cat_img VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, vraag LONGTEXT NOT NULL, created_at DATETIME NOT NULL, is_answered TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, naam VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, beschrijving LONGTEXT NOT NULL, link VARCHAR(255) NOT NULL, adres VARCHAR(255) NOT NULL, postcode VARCHAR(255) NOT NULL, locatie VARCHAR(255) NOT NULL, event_start DATETIME NOT NULL, event_end DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_deleted TINYINT(1) NOT NULL, INDEX IDX_5387574A9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lessen (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, datum VARCHAR(255) NOT NULL, klasgroep VARCHAR(255) NOT NULL, locatie VARCHAR(255) NOT NULL, adres VARCHAR(255) NOT NULL, postcode VARCHAR(255) NOT NULL, gemeente VARCHAR(255) NOT NULL, INDEX IDX_29B9C799D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pagina (id INT AUTO_INCREMENT NOT NULL, pagina_naam VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sections (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, naam VARCHAR(255) NOT NULL, h1_titel VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_deleted TINYINT(1) NOT NULL, INDEX IDX_2B9643989D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sections_pagina (sections_id INT NOT NULL, pagina_id INT NOT NULL, INDEX IDX_BB2387F8577906E4 (sections_id), INDEX IDX_BB2387F857991ECF (pagina_id), PRIMARY KEY(sections_id, pagina_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE textfield (id INT AUTO_INCREMENT NOT NULL, section_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, tekst LONGTEXT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_deleted TINYINT(1) NOT NULL, INDEX IDX_1AE4B76E813F933 (section_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE works (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, naam VARCHAR(255) NOT NULL, filename VARCHAR(255) NOT NULL, beschrijving LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_deleted TINYINT(1) NOT NULL, INDEX IDX_F6E502439D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE works_category (works_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_1FE517AAF6CB822A (works_id), INDEX IDX_1FE517AA12469DE2 (category_id), PRIMARY KEY(works_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lessen ADD CONSTRAINT FK_29B9C799D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sections ADD CONSTRAINT FK_2B9643989D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sections_pagina ADD CONSTRAINT FK_BB2387F8577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sections_pagina ADD CONSTRAINT FK_BB2387F857991ECF FOREIGN KEY (pagina_id) REFERENCES pagina (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE textfield ADD CONSTRAINT FK_1AE4B76E813F933 FOREIGN KEY (section_id_id) REFERENCES sections (id)');
        $this->addSql('ALTER TABLE works ADD CONSTRAINT FK_F6E502439D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE works_category ADD CONSTRAINT FK_1FE517AAF6CB822A FOREIGN KEY (works_id) REFERENCES works (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE works_category ADD CONSTRAINT FK_1FE517AA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE works_category DROP FOREIGN KEY FK_1FE517AA12469DE2');
        $this->addSql('ALTER TABLE sections_pagina DROP FOREIGN KEY FK_BB2387F857991ECF');
        $this->addSql('ALTER TABLE sections_pagina DROP FOREIGN KEY FK_BB2387F8577906E4');
        $this->addSql('ALTER TABLE textfield DROP FOREIGN KEY FK_1AE4B76E813F933');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574A9D86650F');
        $this->addSql('ALTER TABLE lessen DROP FOREIGN KEY FK_29B9C799D86650F');
        $this->addSql('ALTER TABLE sections DROP FOREIGN KEY FK_2B9643989D86650F');
        $this->addSql('ALTER TABLE works DROP FOREIGN KEY FK_F6E502439D86650F');
        $this->addSql('ALTER TABLE works_category DROP FOREIGN KEY FK_1FE517AAF6CB822A');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE lessen');
        $this->addSql('DROP TABLE pagina');
        $this->addSql('DROP TABLE sections');
        $this->addSql('DROP TABLE sections_pagina');
        $this->addSql('DROP TABLE textfield');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE works');
        $this->addSql('DROP TABLE works_category');
    }
}
