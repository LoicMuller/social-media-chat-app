<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220701112620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add status data in db';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO status (name) VALUES ('sent')");
        $this->addSql("INSERT INTO status (name) VALUES ('planified')");
    }
}
