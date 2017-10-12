<?php
class DatabaseMigrator
{
    /* @var Models $Models*/
    public $Models;

    /* @var IDatabaseDriver $Database*/
    public $Database;

    /* @var Core $Core */
    public $Core;

    /* @var IDatabaseMigratorTask[] $QueuedTasks */
    private $QueuedTasks = array();

    public function __construct($models, $database, $core)
    {
        $this->Models = $models;
        $this->Database = $database;
        $this->Core = $core;
    }

    public function CreateTable($tableName)
    {

        $result = new DatabaseTableBuilder($tableName);
        $this->QueuedTasks[] = $result;

        return $result;
    }

    public function DropTable($tableName)
    {
        $this->QueuedTasks[] = new DatabaseDropTable($tableName);
    }

    public function AddModel($model)
    {
        $this->QueuedTasks[] = new DatabaseSeed($model);
    }

    public function Up()
    {
        foreach($this->FindAllMigrations() as $file){
            $this->RunMigrationUp($file['className'], $file['fileName']);
        }
    }

    public function Down()
    {
        foreach($this->FindAllMigrations() as $file){
            $this->RunMigrationDown($file['className'], $file['fileName']);
        }
    }

    public function Seed()
    {
        foreach($this->FindAllMigrations() as $file){
            $this->RunMigrationSeed($file['className'], $file['fileName']);
        }
    }

    public function FindAllMigrations()
    {
        $migrationFolder = Directory($this->Core->GetDatabaseMigrationFolder());
        if(!is_dir($migrationFolder)){
            return array();
        }

        $result = array();
        foreach(GetAllFiles($migrationFolder) as $file){
            $result[] = array(
                'className' => explode('.', $file)[0],
                'fileName' => $migrationFolder . $file
            );
        }

        return $result;
    }

    public function RunMigrationUp($className, $fileName)
    {
        require_once ($fileName);
        $migration = new $className();
        echo "Running $fileName\n";
        $migration->Up($this);
        $this->RunTasks();
    }

    public function RunMigrationDown($className, $fileName)
    {
        require_once ($fileName);
        $migration = new $className();
        echo "Running $fileName\n";
        $migration->Down($this);
        $this->RunTasks();
    }

    public function RunMigrationSeed($className, $fileName)
    {
        require_once ($fileName);
        $migration = new $className();
        echo "Running $fileName\n";
        $migration->Seed($this);
        $this->RunTasks();
    }

    public function RunTasks()
    {
        foreach($this->QueuedTasks as $task){
            echo $task->Description() . "... ";
            $result = $task->Execute($this);
            var_dump($result);
            if($result === true){
                echo "done!\n";
            }else{
                echo "failed!\n";
                echo $result . "\n";
            }
        }
    }
}