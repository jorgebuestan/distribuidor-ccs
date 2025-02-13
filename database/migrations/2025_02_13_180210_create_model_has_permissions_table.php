<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained('permissions');
            $table->morphs('model');
            $table->primary(['permission_id', 'model_id', 'model_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_has_permissions');
    }
};
