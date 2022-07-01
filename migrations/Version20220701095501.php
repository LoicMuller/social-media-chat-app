<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220701095501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'setup db';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE linked_accounts (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, social_media_id_id INT NOT NULL, INDEX IDX_A4C8D0739D86650F (user_id_id), INDEX IDX_A4C8D07315F9AAC8 (social_media_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, status_id_id INT NOT NULL, content VARCHAR(555) NOT NULL, planified_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B6BD307F9D86650F (user_id_id), INDEX IDX_B6BD307F881ECFA7 (status_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_social_media (message_id INT NOT NULL, social_media_id INT NOT NULL, INDEX IDX_E4BD2078537A1329 (message_id), INDEX IDX_E4BD207864AE4959 (social_media_id), PRIMARY KEY(message_id, social_media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE linked_accounts ADD CONSTRAINT FK_A4C8D0739D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE linked_accounts ADD CONSTRAINT FK_A4C8D07315F9AAC8 FOREIGN KEY (social_media_id_id) REFERENCES social_media (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F881ECFA7 FOREIGN KEY (status_id_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE message_social_media ADD CONSTRAINT FK_E4BD2078537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_social_media ADD CONSTRAINT FK_E4BD207864AE4959 FOREIGN KEY (social_media_id) REFERENCES social_media (id) ON DELETE CASCADE');
    }
}
