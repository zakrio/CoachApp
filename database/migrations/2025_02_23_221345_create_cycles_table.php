<?php

declare(strict_types=1);

use App\Models\Coach;
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
        Schema::create('cycles', static function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('type');
            $table->foreignIdFor(Coach::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
