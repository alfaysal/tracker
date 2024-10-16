<?php

use App\Enums\VaccinatedStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nid')->unique();
            $table->tinyInteger('vaccination_status')->default(VaccinatedStatus::NOT_REGISTERED);
            $table->unsignedBigInteger('vaccine_center_id')->nullable();
            $table->timestamp('vaccinated_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nid');
            $table->dropColumn('vaccination_status');
            $table->dropColumn('vaccine_center_id');
            $table->dropColumn('vaccinated_at');
            $table->dropColumn('scheduled_at');
        });
    }
};
