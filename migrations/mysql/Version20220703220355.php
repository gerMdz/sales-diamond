<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703220355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', updated_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', content_changed_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(510) NOT NULL, description VARCHAR(1024) DEFAULT NULL, is_available TINYINT(1) NOT NULL, identifier VARCHAR(100) NOT NULL, is_for_sale TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D34A04ADDE12AB56 (created_by), INDEX IDX_D34A04AD16FE72E1 (updated_by), INDEX IDX_D34A04AD8985DB6D (content_changed_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDE12AB56 FOREIGN KEY (created_by) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD16FE72E1 FOREIGN KEY (updated_by) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD8985DB6D FOREIGN KEY (content_changed_by) REFERENCES `users` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product');
    }
}
