<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601224346 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, accreditation INT DEFAULT NULL, created_at DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX IDX_6AAB231F788A0C1F ON animal');
        $this->addSql('ALTER TABLE animal DROP user_iduser_id, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_B6BD307F5737565A ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F788A0C1F ON message');
        $this->addSql('ALTER TABLE message ADD ask_esthetic_treatment TINYINT(1) DEFAULT NULL, DROP user_iduser_id, DROP animal_idanimal_id, CHANGE ask_health ask_health TINYINT(1) NOT NULL, CHANGE date_sender date_sending DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE animal ADD user_iduser_id INT NOT NULL, CHANGE updated_at updated_at DATE DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_6AAB231F788A0C1F ON animal (user_iduser_id)');
        $this->addSql('ALTER TABLE message ADD user_iduser_id INT NOT NULL, ADD animal_idanimal_id INT NOT NULL, DROP ask_esthetic_treatment, CHANGE ask_health ask_health TINYINT(1) DEFAULT NULL, CHANGE date_sending date_sender DATE NOT NULL');
        $this->addSql('CREATE INDEX IDX_B6BD307F5737565A ON message (animal_idanimal_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F788A0C1F ON message (user_iduser_id)');
    }
}
