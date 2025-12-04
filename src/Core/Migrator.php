<?php

namespace App\Core;

use PDO;

class Migrator
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function migrate()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        
        $files = scandir(dirname(__DIR__) . '/Migrations');
        $toApply = [];

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $migrationName = pathinfo($file, PATHINFO_FILENAME);
            
            if (!in_array($migrationName, $appliedMigrations)) {
                $toApply[] = $file;
            }
        }

        // Sort to ensure order (001, 002, etc.)
        sort($toApply);

        foreach ($toApply as $file) {
            $className = 'App\\Migrations\\' . pathinfo($file, PATHINFO_FILENAME);
            
            // Since we are using PSR-4, we can just instantiate if the file is loaded.
            // However, we might need to ensure the file is loaded if it's not yet known to composer 
            // (though composer dump-autoload usually handles this, dynamic files might be tricky).
            // But since it's in App\Migrations and follows PSR-4, it should work if we use the class name.
            
            if (class_exists($className)) {
                $migration = new $className($this->db);
                $this->log("Applying migration: $file");
                $migration->up();
                $this->saveMigration(pathinfo($file, PATHINFO_FILENAME));
                $this->log("Applied migration: $file");
            } else {
                // Fallback if autoloading fails for some reason (e.g. new file added without dump-autoload)
                // But in this env, we rely on standard autoloading.
                $this->log("Could not find class $className");
            }
        }
    }

    private function createMigrationsTable()
    {
        $this->db->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    }

    private function getAppliedMigrations()
    {
        $stmt = $this->db->prepare("SELECT migration FROM migrations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function saveMigration($migration)
    {
        $stmt = $this->db->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
        $stmt->execute(['migration' => $migration]);
    }

    private function log($message)
    {
        // For now, maybe just error_log or silent. 
        // Since it runs on page load, we don't want to echo output unless debugging.
        error_log("[Migrator] " . $message);
    }
}
