<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190115030208 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, sort_order INT NOT NULL, is_active TINYINT(1) NOT NULL, parent INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scheduler CHANGE description description MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE sync_history CHANGE source source MEDIUMTEXT NOT NULL, CHANGE error error MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE revel_to_netsuite_history CHANGE error error MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE netsuite_to_revel_history CHANGE error error MEDIUMTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE category');
        $this->addSql('ALTER TABLE netsuite_to_revel_history CHANGE error error MEDIUMTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE revel_to_netsuite_history CHANGE error error MEDIUMTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE scheduler CHANGE description description MEDIUMTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE sync_history CHANGE source source MEDIUMTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE error error MEDIUMTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
