<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802183225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD afterbuy_account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939895835496 FOREIGN KEY (afterbuy_account_id) REFERENCES afterbuy_account (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F529939895835496 ON `order` (afterbuy_account_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939895835496');
        $this->addSql('DROP INDEX UNIQ_F529939895835496 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP afterbuy_account_id');
    }
}
