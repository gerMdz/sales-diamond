<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706100418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE budget_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE budget (id UUID NOT NULL, cliente_id UUID DEFAULT NULL, created_by UUID DEFAULT NULL, updated_by UUID DEFAULT NULL, content_changed_by UUID DEFAULT NULL, aclaraciones TEXT DEFAULT NULL, cliente_confirma VARCHAR(100) DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, nro_budget INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_73F2F77BDE734E51 ON budget (cliente_id)');
        $this->addSql('CREATE INDEX IDX_73F2F77BDE12AB56 ON budget (created_by)');
        $this->addSql('CREATE INDEX IDX_73F2F77B16FE72E1 ON budget (updated_by)');
        $this->addSql('CREATE INDEX IDX_73F2F77B8985DB6D ON budget (content_changed_by)');
        $this->addSql('COMMENT ON COLUMN budget.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN budget.cliente_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN budget.created_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN budget.updated_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN budget.content_changed_by IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE budget_product (budget_id UUID NOT NULL, product_id UUID NOT NULL, PRIMARY KEY(budget_id, product_id))');
        $this->addSql('CREATE INDEX IDX_11C94E4C36ABA6B8 ON budget_product (budget_id)');
        $this->addSql('CREATE INDEX IDX_11C94E4C4584665A ON budget_product (product_id)');
        $this->addSql('COMMENT ON COLUMN budget_product.budget_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN budget_product.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE cliente (id UUID NOT NULL, created_by UUID DEFAULT NULL, updated_by UUID DEFAULT NULL, content_changed_by UUID DEFAULT NULL, razon_social VARCHAR(255) NOT NULL, address VARCHAR(510) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, emial VARCHAR(255) DEFAULT NULL, cuit VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F41C9B25DE12AB56 ON cliente (created_by)');
        $this->addSql('CREATE INDEX IDX_F41C9B2516FE72E1 ON cliente (updated_by)');
        $this->addSql('CREATE INDEX IDX_F41C9B258985DB6D ON cliente (content_changed_by)');
        $this->addSql('COMMENT ON COLUMN cliente.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cliente.created_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cliente.updated_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cliente.content_changed_by IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE item_budget (id UUID NOT NULL, budget_id UUID NOT NULL, producto_id UUID NOT NULL, created_by UUID DEFAULT NULL, updated_by UUID DEFAULT NULL, content_changed_by UUID DEFAULT NULL, costo DOUBLE PRECISION DEFAULT NULL, unidad_costo VARCHAR(20) DEFAULT NULL, cantidad_costo DOUBLE PRECISION DEFAULT NULL, excendentes TEXT DEFAULT NULL, excedentes_costo DOUBLE PRECISION DEFAULT NULL, observacion TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F50B82B436ABA6B8 ON item_budget (budget_id)');
        $this->addSql('CREATE INDEX IDX_F50B82B47645698E ON item_budget (producto_id)');
        $this->addSql('CREATE INDEX IDX_F50B82B4DE12AB56 ON item_budget (created_by)');
        $this->addSql('CREATE INDEX IDX_F50B82B416FE72E1 ON item_budget (updated_by)');
        $this->addSql('CREATE INDEX IDX_F50B82B48985DB6D ON item_budget (content_changed_by)');
        $this->addSql('COMMENT ON COLUMN item_budget.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN item_budget.budget_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN item_budget.producto_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN item_budget.created_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN item_budget.updated_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN item_budget.content_changed_by IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE product (id UUID NOT NULL, created_by UUID DEFAULT NULL, updated_by UUID DEFAULT NULL, content_changed_by UUID DEFAULT NULL, title VARCHAR(510) NOT NULL, description VARCHAR(1024) DEFAULT NULL, is_available BOOLEAN NOT NULL, identifier VARCHAR(100) NOT NULL, is_for_sale BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04ADDE12AB56 ON product (created_by)');
        $this->addSql('CREATE INDEX IDX_D34A04AD16FE72E1 ON product (updated_by)');
        $this->addSql('CREATE INDEX IDX_D34A04AD8985DB6D ON product (content_changed_by)');
        $this->addSql('COMMENT ON COLUMN product.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN product.created_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN product.updated_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN product.content_changed_by IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id UUID NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE roles (id UUID NOT NULL, nombre VARCHAR(255) NOT NULL, identificador VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, is_activo BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN roles.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "users" (id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, full_name VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON "users" (email)');
        $this->addSql('COMMENT ON COLUMN "users".id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77BDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77BDE12AB56 FOREIGN KEY (created_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77B16FE72E1 FOREIGN KEY (updated_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77B8985DB6D FOREIGN KEY (content_changed_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE budget_product ADD CONSTRAINT FK_11C94E4C36ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE budget_product ADD CONSTRAINT FK_11C94E4C4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25DE12AB56 FOREIGN KEY (created_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B2516FE72E1 FOREIGN KEY (updated_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B258985DB6D FOREIGN KEY (content_changed_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B436ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B47645698E FOREIGN KEY (producto_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B4DE12AB56 FOREIGN KEY (created_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B416FE72E1 FOREIGN KEY (updated_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_budget ADD CONSTRAINT FK_F50B82B48985DB6D FOREIGN KEY (content_changed_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDE12AB56 FOREIGN KEY (created_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD16FE72E1 FOREIGN KEY (updated_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD8985DB6D FOREIGN KEY (content_changed_by) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "user"');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE budget_product DROP CONSTRAINT FK_11C94E4C36ABA6B8');
        $this->addSql('ALTER TABLE item_budget DROP CONSTRAINT FK_F50B82B436ABA6B8');
        $this->addSql('ALTER TABLE budget DROP CONSTRAINT FK_73F2F77BDE734E51');
        $this->addSql('ALTER TABLE budget_product DROP CONSTRAINT FK_11C94E4C4584665A');
        $this->addSql('ALTER TABLE item_budget DROP CONSTRAINT FK_F50B82B47645698E');
        $this->addSql('ALTER TABLE budget DROP CONSTRAINT FK_73F2F77BDE12AB56');
        $this->addSql('ALTER TABLE budget DROP CONSTRAINT FK_73F2F77B16FE72E1');
        $this->addSql('ALTER TABLE budget DROP CONSTRAINT FK_73F2F77B8985DB6D');
        $this->addSql('ALTER TABLE cliente DROP CONSTRAINT FK_F41C9B25DE12AB56');
        $this->addSql('ALTER TABLE cliente DROP CONSTRAINT FK_F41C9B2516FE72E1');
        $this->addSql('ALTER TABLE cliente DROP CONSTRAINT FK_F41C9B258985DB6D');
        $this->addSql('ALTER TABLE item_budget DROP CONSTRAINT FK_F50B82B4DE12AB56');
        $this->addSql('ALTER TABLE item_budget DROP CONSTRAINT FK_F50B82B416FE72E1');
        $this->addSql('ALTER TABLE item_budget DROP CONSTRAINT FK_F50B82B48985DB6D');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADDE12AB56');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD16FE72E1');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD8985DB6D');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('DROP SEQUENCE budget_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, full_name VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('DROP TABLE budget');
        $this->addSql('DROP TABLE budget_product');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE item_budget');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE "users"');
    }
}
