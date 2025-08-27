<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250826194706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car_brands (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_models (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, model_id INT NOT NULL, photo VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_95C71D1444F5D008 (brand_id), INDEX IDX_95C71D147975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit_programs (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, interest_rate DOUBLE(10,1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loan_applications (id INT AUTO_INCREMENT NOT NULL, car_id INT NOT NULL, program_id INT NOT NULL, loan_term INT NOT NULL, INDEX IDX_86DC2226C3C6F69F (car_id), INDEX IDX_86DC22263EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1444F5D008 FOREIGN KEY (brand_id) REFERENCES car_brands (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D147975B7E7 FOREIGN KEY (model_id) REFERENCES car_models (id)');
        $this->addSql('ALTER TABLE loan_applications ADD CONSTRAINT FK_86DC2226C3C6F69F FOREIGN KEY (car_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE loan_applications ADD CONSTRAINT FK_86DC22263EB8070A FOREIGN KEY (program_id) REFERENCES credit_programs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D1444F5D008');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D147975B7E7');
        $this->addSql('ALTER TABLE loan_applications DROP FOREIGN KEY FK_86DC2226C3C6F69F');
        $this->addSql('ALTER TABLE loan_applications DROP FOREIGN KEY FK_86DC22263EB8070A');
        $this->addSql('DROP TABLE car_brands');
        $this->addSql('DROP TABLE car_models');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE credit_programs');
        $this->addSql('DROP TABLE loan_applications');
    }
}
