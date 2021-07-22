<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718145905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_rule_entry (id INT AUTO_INCREMENT NOT NULL, category_rule_id INT NOT NULL, is_excluding TINYINT(1) NOT NULL, entry VARCHAR(255) NOT NULL, INDEX IDX_C30DEDCEB396432F (category_rule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_rule_entry ADD CONSTRAINT FK_C30DEDCEB396432F FOREIGN KEY (category_rule_id) REFERENCES category_rule (id)');
        $this->addSql('ALTER TABLE category_rule DROP is_stop');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category_rule_entry');
        $this->addSql('ALTER TABLE category_rule ADD is_stop TINYINT(1) NOT NULL');
    }
}
