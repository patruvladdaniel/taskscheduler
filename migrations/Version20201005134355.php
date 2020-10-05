<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005134355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(255) NOT NULL, hours TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO task(text, hours) VALUES ("Lorem ipsum dolor sit amet",  "08:00:00" )');
        $this->addSql('INSERT INTO task(text, hours) VALUES ("Ut enim ad minim veniam", "03:30:00" )');
        $this->addSql('INSERT INTO task(text, hours) VALUES ("Duis aute irure dolor in reprehenderit in voluptate velit", "13:00:00" )');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE task');
    }
}
