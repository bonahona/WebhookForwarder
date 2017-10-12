<?php
class DbCreation implements IDatabaseMigration
{
    public function Up($migrator)
    {
        $migrator->CreateTable('ForwardRule')
            ->AddPrimaryKey('Id', 'int')
            ->AddColumn('MatchingPath', 'varchar(512)')
            ->AddColumn('ForwardAddress', 'varchar(512)');

        $migrator->CreateTable('ForwardLog')
            ->AddPrimaryKey('Id', 'int')
            ->AddColumn('Payload', 'varchar(8192)')
            ->AddReference('ForwardRule', 'Id', array('not null'));
    }

    public function Down($migrator)
    {
        $migrator->DropTable('ForwardLog');
        $migrator->DropTable('ForwardRule');
    }

    public function Seed($migrator)
    {
    }
}