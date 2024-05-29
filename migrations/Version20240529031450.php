<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529031450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD COLUMN description_common VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD COLUMN description_for_ozon VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD COLUMN description_for_wildberries VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, name, description, weight, category FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, weight VARCHAR(50) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO product (id, name, description, weight, category) SELECT id, name, description, weight, category FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
    }
}
