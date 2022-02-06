<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220206145437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collections_full (id INT AUTO_INCREMENT NOT NULL, collection_id_id INT NOT NULL, user_id_id INT NOT NULL, item_id_id INT NOT NULL, INDEX IDX_8ACCD9A538BC2604 (collection_id_id), INDEX IDX_8ACCD9A59D86650F (user_id_id), INDEX IDX_8ACCD9A555E38587 (item_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collections_full ADD CONSTRAINT FK_8ACCD9A538BC2604 FOREIGN KEY (collection_id_id) REFERENCES item_collections (id)');
        $this->addSql('ALTER TABLE collections_full ADD CONSTRAINT FK_8ACCD9A59D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collections_full ADD CONSTRAINT FK_8ACCD9A555E38587 FOREIGN KEY (item_id_id) REFERENCES items (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE collections_full');
    }
}
