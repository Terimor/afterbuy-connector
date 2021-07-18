<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718121701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_rule (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, entry VARCHAR(255) NOT NULL, INDEX IDX_CD43D68B12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_rule ADD CONSTRAINT FK_CD43D68B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE sold_item ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sold_item ADD CONSTRAINT FK_7D83906C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_7D83906C12469DE2 ON sold_item (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_rule DROP FOREIGN KEY FK_CD43D68B12469DE2');
        $this->addSql('ALTER TABLE sold_item DROP FOREIGN KEY FK_7D83906C12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_rule');
        $this->addSql('DROP INDEX IDX_7D83906C12469DE2 ON sold_item');
        $this->addSql('ALTER TABLE sold_item DROP category_id');
    }
}
