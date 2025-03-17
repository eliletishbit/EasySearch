<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class MigrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function excel_rows_table_has_expected_columns()
    {
        // Vérifie que la table 'excel_rows' existe
        $this->assertTrue(Schema::hasTable('excel_rows'));

        // Vérifie les colonnes de la table
        $this->assertTrue(Schema::hasColumn('excel_rows', 'id'));
        $this->assertTrue(Schema::hasColumn('excel_rows', 'excel_file_id'));
        $this->assertTrue(Schema::hasColumn('excel_rows', 'nom'));
        $this->assertTrue(Schema::hasColumn('excel_rows', 'email'));
        $this->assertTrue(Schema::hasColumn('excel_rows', 'telephone'));
        $this->assertTrue(Schema::hasColumn('excel_rows', 'created_at'));
        $this->assertTrue(Schema::hasColumn('excel_rows', 'updated_at'));
    }

    /** @test */
    public function excel_rows_table_foreign_key_constraint()
    {
        // Vérifie que la contrainte de clé étrangère pour 'excel_file_id' est bien en place
        $foreignKeys = \DB::select(DB::raw('SHOW CREATE TABLE excel_rows'));

        $this->assertStringContainsString('CONSTRAINT `excel_rows_excel_file_id_foreign` FOREIGN KEY (`excel_file_id`) REFERENCES `excel_files`(`id`)', $foreignKeys[0]->{'Create Table'});
    }
}
