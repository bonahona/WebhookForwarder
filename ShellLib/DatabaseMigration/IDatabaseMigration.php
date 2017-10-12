<?php
interface IDatabaseMigration
{
    /* @param DatabaseMigrator $database*/
    function Up($database);

    /* @param DatabaseMigrator $migrator*/
    function Down($migrator);

    /* @param DatabaseMigrator $migrator*/
    function Seed($migrator);
}