<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720151842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD precio_lista DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD precio_promo DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD is_promo BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE product DROP value_for_sale');
        $this->addSql('ALTER TABLE product DROP unidad_venta');
        $this->addSql('ALTER TABLE product ALTER is_for_sale SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product ADD value_for_sale INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD unidad_venta VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE product DROP precio_lista');
        $this->addSql('ALTER TABLE product DROP precio_promo');
        $this->addSql('ALTER TABLE product DROP is_promo');
        $this->addSql('ALTER TABLE product ALTER is_for_sale DROP NOT NULL');
    }
}
