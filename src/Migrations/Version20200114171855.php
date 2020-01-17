<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114171855 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE links (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, fshare VARCHAR(255) DEFAULT NULL, google_drive VARCHAR(255) DEFAULT NULL, steam VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D182A1184B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE minimum_requirements (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, os VARCHAR(255) NOT NULL, processor VARCHAR(255) NOT NULL, memory VARCHAR(255) NOT NULL, graphics VARCHAR(255) NOT NULL, disk_space VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D49CB2DC4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_genre (post_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_144BBF174B89032C (post_id), INDEX IDX_144BBF174296D31F (genre_id), PRIMARY KEY(post_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recommended_requirements (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, os VARCHAR(255) NOT NULL, processor VARCHAR(255) NOT NULL, memory VARCHAR(255) NOT NULL, graphics VARCHAR(255) NOT NULL, disk_space VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CD259D364B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE screenshots (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1A8D27134B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE links ADD CONSTRAINT FK_D182A1184B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE minimum_requirements ADD CONSTRAINT FK_D49CB2DC4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post_genre ADD CONSTRAINT FK_144BBF174B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_genre ADD CONSTRAINT FK_144BBF174296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recommended_requirements ADD CONSTRAINT FK_CD259D364B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE screenshots ADD CONSTRAINT FK_1A8D27134B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_genre DROP FOREIGN KEY FK_144BBF174296D31F');
        $this->addSql('ALTER TABLE links DROP FOREIGN KEY FK_D182A1184B89032C');
        $this->addSql('ALTER TABLE minimum_requirements DROP FOREIGN KEY FK_D49CB2DC4B89032C');
        $this->addSql('ALTER TABLE post_genre DROP FOREIGN KEY FK_144BBF174B89032C');
        $this->addSql('ALTER TABLE recommended_requirements DROP FOREIGN KEY FK_CD259D364B89032C');
        $this->addSql('ALTER TABLE screenshots DROP FOREIGN KEY FK_1A8D27134B89032C');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE links');
        $this->addSql('DROP TABLE minimum_requirements');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_genre');
        $this->addSql('DROP TABLE recommended_requirements');
        $this->addSql('DROP TABLE screenshots');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
