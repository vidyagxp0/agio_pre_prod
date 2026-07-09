<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Production-safe performance indexes for QMS dashboard/modal/workflow reads.
     * This migration DOES NOT change/delete any data. It only adds indexes when
     * the table + column exist and the same index is not already present.
     */
    public function up(): void
    {
        $indexes = [
            'c_c_s' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'action_items' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'extension_news' => ['id', 'site_location_code', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator'],
            'effectiveness_checks' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_record', 'parent_type', 'initiator_id'],
            'internal_audits' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'capas' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'risk_management' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'management_reviews' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'lab_incidents' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'auditees' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'audit_programs' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'root_cause_analyses' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'observations' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'o_o_s' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'marketcompalints' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'ootcs' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'errata' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'o_o_s__micros' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'deviations' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'out_of_calibrations' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'incidents' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'resamplings' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'change_proposal_justs' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'failure_investigations' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'non_conformances' => ['id', 'division_id', 'status', 'created_at', 'updated_at', 'parent_id', 'parent_type', 'initiator_id'],
            'q_m_s_divisions' => ['id', 'status'],
            'users' => ['id'],
            'user_roles' => ['user_id', 'q_m_s_divisions_id', 'q_m_s_roles_id'],
            'q_m_s_processes' => ['process_name'],
        ];

        foreach ($indexes as $table => $columns) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            foreach ($columns as $column) {
                if (!Schema::hasColumn($table, $column)) {
                    continue;
                }

                $indexName = $this->indexName($table, $column);
                if (!$this->indexExists($table, $indexName)) {
                    DB::statement("ALTER TABLE `{$table}` ADD INDEX `{$indexName}` (`{$column}`)");
                }
            }
        }
    }

    public function down(): void
    {
        // Intentionally conservative. Dropping indexes in production can be risky.
        // Remove manually only if needed.
    }

    private function indexName(string $table, string $column): string
    {
        $name = 'idx_perf_' . $table . '_' . $column;
        return substr(preg_replace('/[^A-Za-z0-9_]/', '_', $name), 0, 64);
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $database = DB::getDatabaseName();

        return DB::table('information_schema.statistics')
            ->where('table_schema', $database)
            ->where('table_name', $table)
            ->where('index_name', $indexName)
            ->exists();
    }
};
