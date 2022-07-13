<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713121921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE budget_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE nro_factura_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE nro_factura (id INT NOT NULL, budget_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F0C2891F36ABA6B8 ON nro_factura (budget_id)');
        $this->addSql('COMMENT ON COLUMN nro_factura.budget_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE nro_factura ADD CONSTRAINT FK_F0C2891F36ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD value_for_sale INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ALTER is_for_sale DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE nro_factura_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE budget_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE nro_factura');
        $this->addSql('ALTER TABLE product DROP value_for_sale');
        $this->addSql('ALTER TABLE product ALTER is_for_sale SET NOT NULL');
    }
}
