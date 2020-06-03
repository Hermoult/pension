<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200602075624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE animal ADD user_iduser_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F788A0C1F FOREIGN KEY (user_iduser_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F788A0C1F ON animal (user_iduser_id)');
        $this->addSql('ALTER TABLE message ADD user_iduser_id INT NOT NULL, ADD animal_idanimal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F788A0C1F FOREIGN KEY (user_iduser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5737565A FOREIGN KEY (animal_idanimal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F788A0C1F ON message (user_iduser_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F5737565A ON message (animal_idanimal_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F788A0C1F');
        $this->addSql('DROP INDEX IDX_6AAB231F788A0C1F ON animal');
        $this->addSql('ALTER TABLE animal DROP user_iduser_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F788A0C1F');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F5737565A');
        $this->addSql('DROP INDEX IDX_B6BD307F788A0C1F ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F5737565A ON message');
        $this->addSql('ALTER TABLE message DROP user_iduser_id, DROP animal_idanimal_id');
    }
}
