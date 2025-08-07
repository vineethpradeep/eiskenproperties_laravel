<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangePtypeIdTypeInPropertiesTable extends Migration
{
    public function up(): void
    {
        // Cast ptype_id to bigint using raw SQL
        DB::statement('ALTER TABLE properties ALTER COLUMN ptype_id TYPE BIGINT USING ptype_id::bigint');
    }

    public function down(): void
    {
        // Revert back to string (text)
        DB::statement('ALTER TABLE properties ALTER COLUMN ptype_id TYPE VARCHAR USING ptype_id::varchar');
    }
}
