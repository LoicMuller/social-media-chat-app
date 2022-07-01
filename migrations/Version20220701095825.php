<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220701095825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'edit column names';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE linked_accounts CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE linked_accounts CHANGE social_media_id_id social_media_id INT NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE status_id_id status_id INT NOT NULL');
    }
}
