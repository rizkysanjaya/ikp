<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Backup extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $date = date('Y-m-d_H-i-s');
        $filename = 'backup_ikp_' . $date . '.sql';

        // Header SQL
        $sql = "-- Database Backup for IKP System\n";
        $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
        $sql .= "-- Host: " . $db->hostname . "\n";
        $sql .= "-- Database: " . $db->database . "\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            // Get Create Table Logic
            $query = $db->query("SHOW CREATE TABLE $table");
            $row = $query->getRowArray();
            $sql .= "\n\n" . $row['Create Table'] . ";\n\n";

            // Get Data
            $query = $db->table($table)->get();
            $results = $query->getResultArray();

            foreach ($results as $row) {
                $sql .= "INSERT INTO $table VALUES (";
                $values = [];
                foreach ($row as $value) {
                    if ($value === null) {
                        $values[] = "NULL";
                    } else {
                        $values[] = "'" . $db->escapeString($value) . "'";
                    }
                }
                $sql .= implode(", ", $values);
                $sql .= ");\n";
            }
        }

        $sql .= "\n\nSET FOREIGN_KEY_CHECKS=1;\n";

        // Force Download
        return $this->response
            ->setHeader('Content-Type', 'application/sql')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($sql);
    }
}
