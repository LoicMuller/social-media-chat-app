<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220701113611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add socials in db';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO social_media (name) VALUES ('slack')");
        $this->addSql("INSERT INTO social_media (name) VALUES ('discord')");
    }
}
