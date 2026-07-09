<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Phase-3 QMS performance indexes.
     * Production-safe: only adds indexes. It does not update/delete/drop business data.
     */
    public function up(): void
    {
        $tableColumns = [
            // Main RCMS/QMS process tables
            'c_c_s' => ['division_id', 'record', 'status', 'stage', 'initiator_id', 'initiator', 'created_by', 'created_at', 'updated_at'],
            'action_items' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'capas' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'initiator_id', 'created_by', 'created_at', 'updated_at'],
            'deviations' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'initiator_id', 'created_by', 'created_at', 'updated_at'],
            'incidents' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'initiator_id', 'created_by', 'created_at', 'updated_at'],
            'lab_incidents' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'initiator_id', 'created_by', 'created_at', 'updated_at'],
            'marketcompalints' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'initiator_id', 'created_by', 'created_at', 'updated_at'],
            'risk_management' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'initiator_id', 'created_by', 'created_at', 'updated_at'],
            'internal_audits' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'initiator_id', 'created_by', 'created_at', 'updated_at'],
            'external_audits' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'initiator_id', 'created_by', 'created_at', 'updated_at'],
            'audit_programs' => ['division_id', 'record', 'status', 'stage', 'created_by', 'created_at', 'updated_at'],
            'observations' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'out_of_calibrations' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'management_reviews' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'effectiveness_checks' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'extensions' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'extension_news' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'root_cause_analyses' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'o_o_s' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'o_o_s__micros' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'o_o_t_s' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'non_conformances' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],
            'failure_investigations' => ['division_id', 'record', 'status', 'stage', 'parent_id', 'parent_type', 'created_by', 'created_at', 'updated_at'],

            // DMS / document tables commonly used in lists, print, issue and history
            'documents' => ['division_id', 'document_type_id', 'department_id', 'status', 'stage', 'originator_id', 'created_by', 'created_at', 'updated_at', 'effective_date', 'review_date'],
            'document_contents' => ['document_id', 'created_at', 'updated_at'],
            'document_histories' => ['document_id', 'user_id', 'stage_id', 'created_at'],
            'print_histories' => ['document_id', 'user_id', 'created_at'],
            'download_histories' => ['document_id', 'user_id', 'created_at'],
            'document_trainings' => ['document_id', 'user_id', 'trainee_id', 'trainer_id', 'status', 'created_at'],

            // User/role/division lookup tables
            'users' => ['id', 'departmentid', 'status', 'created_at'],
            'user_roles' => ['user_id', 'q_m_s_roles_id', 'q_m_s_divisions_id', 'created_at'],
            'q_m_s_roles' => ['id', 'name', 'status'],
            'q_m_s_divisions' => ['id', 'name', 'status'],
            'departments' => ['id', 'name', 'status'],
            'q_m_s_processes' => ['id', 'process_name', 'status'],
        ];

        foreach ($tableColumns as $table => $columns) {
            $this->addIndexesForExistingColumns($table, $columns);
        }

        $this->addCompositeIndexIfPossible('c_c_s', ['division_id', 'status', 'created_at']);
        $this->addCompositeIndexIfPossible('deviations', ['division_id', 'status', 'created_at']);
        $this->addCompositeIndexIfPossible('incidents', ['division_id', 'status', 'created_at']);
        $this->addCompositeIndexIfPossible('capas', ['division_id', 'status', 'created_at']);
        $this->addCompositeIndexIfPossible('documents', ['division_id', 'status', 'created_at']);
        $this->addCompositeIndexIfPossible('user_roles', ['user_id', 'q_m_s_roles_id', 'q_m_s_divisions_id']);
    }

    public function down(): void
    {
        // Safe rollback: drop only indexes created by this migration when present.
        $tables = DB::select('SHOW TABLES');
        $dbName = DB::getDatabaseName();
        $keyName = 'Tables_in_' . $dbName;

        foreach ($tables as $tableRow) {
            $table = $tableRow->{$keyName} ?? reset($tableRow);
            if (!$table || !Schema::hasTable($table)) {
                continue;
            }

            $indexes = DB::select("SHOW INDEX FROM `{$table}` WHERE Key_name LIKE 'qms_p3_%'");
            foreach ($indexes as $index) {
                $indexName = $index->Key_name ?? null;
                if ($indexName && $this->indexExists($table, $indexName)) {
                    Schema::table($table, function (Blueprint $blueprint) use ($indexName) {
                        $blueprint->dropIndex($indexName);
                    });
                }
            }
        }
    }

    private function addIndexesForExistingColumns(string $table, array $columns): void
    {
        if (!Schema::hasTable($table)) {
            return;
        }

        foreach ($columns as $column) {
            if (!Schema::hasColumn($table, $column)) {
                continue;
            }

            $indexName = $this->indexName($table, [$column]);
            if ($this->indexExists($table, $indexName) || $this->columnAlreadyIndexed($table, $column)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($column, $indexName) {
                $blueprint->index($column, $indexName);
            });
        }
    }

    private function addCompositeIndexIfPossible(string $table, array $columns): void
    {
        if (!Schema::hasTable($table)) {
            return;
        }

        foreach ($columns as $column) {
            if (!Schema::hasColumn($table, $column)) {
                return;
            }
        }

        $indexName = $this->indexName($table, $columns);
        if ($this->indexExists($table, $indexName)) {
            return;
        }

        Schema::table($table, function (Blueprint $blueprint) use ($columns, $indexName) {
            $blueprint->index($columns, $indexName);
        });
    }

    private function indexName(string $table, array $columns): string
    {
        return 'qms_p3_' . substr(md5($table . '_' . implode('_', $columns)), 0, 24);
    }

    private function indexExists(string $table, string $indexName): bool
    {
        if (!Schema::hasTable($table)) {
            return false;
        }

        $result = DB::select("SHOW INDEX FROM `{$table}` WHERE Key_name = ?", [$indexName]);
        return count($result) > 0;
    }

    private function columnAlreadyIndexed(string $table, string $column): bool
    {
        $indexes = DB::select("SHOW INDEX FROM `{$table}` WHERE Column_name = ?", [$column]);
        return count($indexes) > 0;
    }
};
