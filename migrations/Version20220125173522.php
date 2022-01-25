<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125173522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commentaries_items');
        $this->addSql('DROP TABLE commentaries_user');
        $this->addSql('DROP TABLE tv');
        $this->addSql('ALTER TABLE commentaries CHANGE user_id_id user_id_id INT NOT NULL, CHANGE item_id_id item_id_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaries_items (commentaries_id INT NOT NULL, items_id INT NOT NULL, INDEX IDX_8664200D1B0C88DC (commentaries_id), INDEX IDX_8664200D6BB0AE84 (items_id), PRIMARY KEY(commentaries_id, items_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaries_user (commentaries_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2A105AD21B0C88DC (commentaries_id), INDEX IDX_2A105AD2A76ED395 (user_id), PRIMARY KEY(commentaries_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tv (id INT AUTO_INCREMENT NOT NULL, size SMALLINT NOT NULL, mark VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, model VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, smarttv TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commentaries_items ADD CONSTRAINT FK_8664200D1B0C88DC FOREIGN KEY (commentaries_id) REFERENCES commentaries (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaries_items ADD CONSTRAINT FK_8664200D6BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaries_user ADD CONSTRAINT FK_2A105AD21B0C88DC FOREIGN KEY (commentaries_id) REFERENCES commentaries (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaries_user ADD CONSTRAINT FK_2A105AD2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaries CHANGE user_id_id user_id_id INT DEFAULT NULL, CHANGE item_id_id item_id_id INT DEFAULT NULL');
    }
}
