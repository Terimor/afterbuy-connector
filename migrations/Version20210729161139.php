<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729161139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_rule ADD is_excluding TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE category_rule_entry DROP is_excluding');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_rule DROP is_excluding');
        $this->addSql('ALTER TABLE category_rule_entry ADD is_excluding TINYINT(1) NOT NULL');
    }
}
