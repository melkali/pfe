<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200714224944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE analysis_type (id INT AUTO_INCREMENT NOT NULL, patients_id INT NOT NULL, analysis_name VARCHAR(255) NOT NULL, INDEX IDX_BD6D12C2CEC3FD2F (patients_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patients (id INT AUTO_INCREMENT NOT NULL, payment_sum_id INT DEFAULT NULL, report_patient_id INT NOT NULL, result_patient_id INT NOT NULL, name_patient VARCHAR(255) NOT NULL, firstname_patient VARCHAR(255) NOT NULL, phone INT NOT NULL, date_birth DATE NOT NULL, doctor VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2CCC2E2C78321919 (payment_sum_id), UNIQUE INDEX UNIQ_2CCC2E2C78CBBE42 (report_patient_id), UNIQUE INDEX UNIQ_2CCC2E2C93D298A6 (result_patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payments (id INT AUTO_INCREMENT NOT NULL, name_payment VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, sum INT NOT NULL, content_payment VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE analysis_type ADD CONSTRAINT FK_BD6D12C2CEC3FD2F FOREIGN KEY (patients_id) REFERENCES patients (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C78321919 FOREIGN KEY (payment_sum_id) REFERENCES payments (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C78CBBE42 FOREIGN KEY (report_patient_id) REFERENCES reports (id)');
        $this->addSql('ALTER TABLE patients ADD CONSTRAINT FK_2CCC2E2C93D298A6 FOREIGN KEY (result_patient_id) REFERENCES results (id)');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE analysis_type DROP FOREIGN KEY FK_BD6D12C2CEC3FD2F');
        $this->addSql('ALTER TABLE patients DROP FOREIGN KEY FK_2CCC2E2C78321919');
        $this->addSql('DROP TABLE analysis_type');
        $this->addSql('DROP TABLE patients');
        $this->addSql('DROP TABLE payments');
        $this->addSql('ALTER TABLE users CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
