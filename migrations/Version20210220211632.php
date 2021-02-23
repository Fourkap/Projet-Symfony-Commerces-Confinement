<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210220211632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE codepostal (id INT AUTO_INCREMENT NOT NULL, arrondissement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commerce_codepostal (commerce_id INT NOT NULL, codepostal_id INT NOT NULL, INDEX IDX_F6F5E3D9B09114B7 (commerce_id), INDEX IDX_F6F5E3D9C9B1D722 (codepostal_id), PRIMARY KEY(commerce_id, codepostal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commerce_codepostal ADD CONSTRAINT FK_F6F5E3D9B09114B7 FOREIGN KEY (commerce_id) REFERENCES commerce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commerce_codepostal ADD CONSTRAINT FK_F6F5E3D9C9B1D722 FOREIGN KEY (codepostal_id) REFERENCES codepostal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commerce CHANGE nom_du_commerce nom_du_commerce VARCHAR(250) NOT NULL, CHANGE Adresse adresse VARCHAR(250) NOT NULL, CHANGE code_postal code_postal VARCHAR(250) NOT NULL, CHANGE type_de_commerce type_de_commerce VARCHAR(250) NOT NULL, CHANGE fabrique_a_paris fabrique_a_paris VARCHAR(250) NOT NULL, CHANGE Services services VARCHAR(250) NOT NULL, CHANGE Description description VARCHAR(250) NOT NULL, CHANGE precisions precisions VARCHAR(250) NOT NULL, CHANGE site_internet site_internet VARCHAR(250) NOT NULL, CHANGE telephone telephone VARCHAR(250) NOT NULL, CHANGE Mail mail VARCHAR(250) NOT NULL, CHANGE geo_shape geo_shape VARCHAR(250) NOT NULL, CHANGE geo_point_2d geo_point_2d VARCHAR(250) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commerce_codepostal DROP FOREIGN KEY FK_F6F5E3D9C9B1D722');
        $this->addSql('DROP TABLE codepostal');
        $this->addSql('DROP TABLE commerce_codepostal');
        $this->addSql('ALTER TABLE commerce CHANGE nom_du_commerce nom_du_commerce VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE adresse Adresse VARCHAR(112) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE type_de_commerce type_de_commerce VARCHAR(55) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE fabrique_a_paris fabrique_a_paris VARCHAR(3) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE services Services VARCHAR(54) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE description Description VARCHAR(211) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE precisions precisions VARCHAR(104) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE site_internet site_internet VARCHAR(166) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE telephone telephone VARCHAR(31) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE mail Mail VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE geo_shape geo_shape VARCHAR(74) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, CHANGE geo_point_2d geo_point_2d VARCHAR(27) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`');
    }
}
