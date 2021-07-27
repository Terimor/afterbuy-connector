<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210720154635 extends AbstractMigration
{
    private const ACCOUNTS_TO_ADD = [
        [
            'userId' => 'precoa',
            'userPassword' => 'Delta3201!!!-pre4',
            'partnerId' => '103701',
            'partnerPassword' => 'YTEmJ9JGjTBPJuYuaPLe9Jsfk',
        ],
        [
            'userId' => 'caircon',
            'userPassword' => 'Delta3201!!!-cai4',
            'partnerId' => '102515',
            'partnerPassword' => '9E5X=AzDJE7(ZE0u1dxEI)YQu',
        ],
    ];

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        foreach (self::ACCOUNTS_TO_ADD as $account) {
            $this->addSql(
                'INSERT INTO afterbuy_account
                                        SET user_id = :userId,
                                            user_password = :userPassword,
                                            partner_id = :partnerId,
                                            partner_password = :partnerPassword',
                [
                    'userId' => $account['userId'],
                    'userPassword' => $account['userPassword'],
                    'partnerId' => $account['partnerId'],
                    'partnerPassword' => $account['partnerPassword'],
                ]
            );
        }
    }

    public function down(Schema $schema): void
    {
        $this->throwIrreversibleMigrationException();
    }
}
