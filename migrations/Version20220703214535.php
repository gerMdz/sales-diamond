<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703214535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente ADD created_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD updated_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD content_changed_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25DE12AB56 FOREIGN KEY (created_by) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B2516FE72E1 FOREIGN KEY (updated_by) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B258985DB6D FOREIGN KEY (content_changed_by) REFERENCES `users` (id)');
        $this->addSql('CREATE INDEX IDX_F41C9B25DE12AB56 ON cliente (created_by)');
        $this->addSql('CREATE INDEX IDX_F41C9B2516FE72E1 ON cliente (updated_by)');
        $this->addSql('CREATE INDEX IDX_F41C9B258985DB6D ON cliente (content_changed_by)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B25DE12AB56');
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B2516FE72E1');
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B258985DB6D');
        $this->addSql('DROP INDEX IDX_F41C9B25DE12AB56 ON cliente');
        $this->addSql('DROP INDEX IDX_F41C9B2516FE72E1 ON cliente');
        $this->addSql('DROP INDEX IDX_F41C9B258985DB6D ON cliente');
        $this->addSql('ALTER TABLE cliente DROP created_by, DROP updated_by, DROP content_changed_by, DROP created_at, DROP updated_at');
    }
}
