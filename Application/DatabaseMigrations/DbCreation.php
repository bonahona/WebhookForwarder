<?php
class DbCreation implements IDatabaseMigration
{
    public function Up($migrator)
    {
        $migrator->CreateTable('ForwardRule')
            ->AddPrimaryKey('Id', 'int')
            ->AddColumn('MatchingPath', 'varchar(512)')
            ->AddColumn('ForwardAddress', 'varchar(512)')
            ->AddColumn('IsActive', 'int(1)', array('default 1'))
            ->AddColumn('IsDeleted', 'int(1)', array('default 0'));

        $migrator->CreateTable('ForwardLog')
            ->AddPrimaryKey('Id', 'int')
            ->AddColumn('Payload', 'varchar(8192)')
            ->AddColumn('DateTime', 'varchar(128)')
            ->AddColumn('Source', 'varchar(512)')
            ->AddColumn('Success', 'int(1)', array('not null'))
            ->AddReference('ForwardRule', 'Id',  array('not null'));
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