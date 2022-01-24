<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220117064914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaries (id INT AUTO_INCREMENT NOT NULL, datecomment DATETIME NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaries_user (commentaries_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2A105AD21B0C88DC (commentaries_id), INDEX IDX_2A105AD2A76ED395 (user_id), PRIMARY KEY(commentaries_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaries_items (commentaries_id INT NOT NULL, items_id INT NOT NULL, INDEX IDX_8664200D1B0C88DC (commentaries_id), INDEX IDX_8664200D6BB0AE84 (items_id), PRIMARY KEY(commentaries_id, items_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items (id INT AUTO_INCREMENT NOT NULL, name_item VARCHAR(50) NOT NULL, tag_item LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', id_category INT NOT NULL, image_items VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaries_user ADD CONSTRAINT FK_2A105AD21B0C88DC FOREIGN KEY (commentaries_id) REFERENCES commentaries (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaries_user ADD CONSTRAINT FK_2A105AD2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaries_items ADD CONSTRAINT FK_8664200D1B0C88DC FOREIGN KEY (commentaries_id) REFERENCES commentaries (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaries_items ADD CONSTRAINT FK_8664200D6BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaries_user DROP FOREIGN KEY FK_2A105AD21B0C88DC');
        $this->addSql('ALTER TABLE commentaries_items DROP FOREIGN KEY FK_8664200D1B0C88DC');
        $this->addSql('ALTER TABLE commentaries_items DROP FOREIGN KEY FK_8664200D6BB0AE84');
        $this->addSql('DROP TABLE commentaries');
        $this->addSql('DROP TABLE commentaries_user');
        $this->addSql('DROP TABLE commentaries_items');
        $this->addSql('DROP TABLE items');
    }
}
