<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703224936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE budget (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', cliente_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', updated_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', content_changed_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', aclaraciones LONGTEXT DEFAULT NULL, cliente_confirma VARCHAR(100) DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, nro_budget INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_73F2F77BDE734E51 (cliente_id), INDEX IDX_73F2F77BDE12AB56 (created_by), INDEX IDX_73F2F77B16FE72E1 (updated_by), INDEX IDX_73F2F77B8985DB6D (content_changed_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE budget_product (budget_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', product_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_11C94E4C36ABA6B8 (budget_id), INDEX IDX_11C94E4C4584665A (product_id), PRIMARY KEY(budget_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_budget (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', budget_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', producto_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', updated_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', content_changed_by BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', costo DOUBLE PRECISION DEFAULT NULL, unidad_costo VARCHAR(20) DEFAULT NULL, cantidad_costo DOUBLE PRECISION DEFAULT NULL, excendentes LONGTEXT DEFAULT NULL, excedentes_costo DOUBLE PRECISION DEFAULT NULL, observacion LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F50B82B436ABA6B8 (budget_id), INDEX IDX_F50B82B47645698E (producto_id), INDEX IDX_F50B82B4DE12AB56 (created_by), INDEX IDX_F50B82B416FE72E1 (updated_by), INDEX IDX_F50B82B48985DB6D (content_changed_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77BDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77BDE12AB56 FOREIGN KEY (created_by) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77B16FE72E1 FOREIGN KEY (updated_by) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77B8985DB6D FOREIGN KEY (content_changed_by) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE budget_product ADD CONSTRAINT FK_11C94E4C36ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE budget_product ADD CONSTRAINT FK_11C94E4C4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B436ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id)');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B47645698E FOREIGN KEY (producto_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B4DE12AB56 FOREIGN KEY (created_by) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B416FE72E1 FOREIGN KEY (updated_by) REFERENCES `users` (id)');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B48985DB6D FOREIGN KEY (content_changed_by) REFERENCES `users` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE budget_product DROP FOREIGN KEY FK_11C94E4C36ABA6B8');
        $this->addSql('ALTER TABLE item_budget DROP FOREIGN KEY FK_F50B82B436ABA6B8');
        $this->addSql('DROP TABLE budget');
        $this->addSql('DROP TABLE budget_product');
        $this->addSql('DROP TABLE item_budget');
    }
}
