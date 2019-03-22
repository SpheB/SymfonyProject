<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190322145021 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fan_comment (id INT AUTO_INCREMENT NOT NULL, id_look_id INT DEFAULT NULL, id_fan_id INT NOT NULL, text_comment LONGTEXT NOT NULL, date_comment DATETIME NOT NULL, INDEX IDX_FC7CB497980061AC (id_look_id), INDEX IDX_FC7CB497AFF33AE6 (id_fan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fan_comment ADD CONSTRAINT FK_FC7CB497980061AC FOREIGN KEY (id_look_id) REFERENCES look (id)');
        $this->addSql('ALTER TABLE fan_comment ADD CONSTRAINT FK_FC7CB497AFF33AE6 FOREIGN KEY (id_fan_id) REFERENCES fan (id)');
        $this->addSql('ALTER TABLE concours CHANGE gagnant_id gagnant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fan CHANGE roles roles JSON NOT NULL, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE look CHANGE id_style_id id_style_id INT DEFAULT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL, CHANGE likes likes INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vote CHANGE id_concours_id id_concours_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE fan_comment');
        $this->addSql('ALTER TABLE concours CHANGE gagnant_id gagnant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fan CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE avatar avatar VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE look CHANGE id_style_id id_style_id INT DEFAULT NULL, CHANGE picture picture VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE likes likes INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vote CHANGE id_concours_id id_concours_id INT DEFAULT NULL');
    }
}
