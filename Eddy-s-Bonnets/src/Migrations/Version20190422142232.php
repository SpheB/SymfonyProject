<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422142232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE concours CHANGE gagnant_id gagnant_id INT DEFAULT NULL, CHANGE comment_concours comment_concours VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE fan CHANGE roles roles JSON NOT NULL, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fan_comment CHANGE id_look_id id_look_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE look CHANGE id_style_id id_style_id INT DEFAULT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL, CHANGE likes likes INT DEFAULT NULL, CHANGE description description VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE news ADD accroche VARCHAR(20) DEFAULT NULL, CHANGE date_news date_news DATETIME DEFAULT NULL, CHANGE picture_news picture_news VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vote CHANGE id_concours_id id_concours_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE concours CHANGE gagnant_id gagnant_id INT DEFAULT NULL, CHANGE comment_concours comment_concours VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE fan CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE avatar avatar VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE fan_comment CHANGE id_look_id id_look_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE look CHANGE id_style_id id_style_id INT DEFAULT NULL, CHANGE picture picture VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE likes likes INT DEFAULT NULL, CHANGE description description VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE news DROP accroche, CHANGE date_news date_news DATETIME DEFAULT \'NULL\', CHANGE picture_news picture_news VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE vote CHANGE id_concours_id id_concours_id INT DEFAULT NULL');
    }
}
