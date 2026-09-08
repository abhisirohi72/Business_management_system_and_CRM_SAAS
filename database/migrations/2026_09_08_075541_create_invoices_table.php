<?php

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('quotation_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('invoice_number');

            $table->date('invoice_date');
            $table->date('due_date');

            $table->string('status')->default('draft');

            $table->decimal('sub_total', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);

            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);

            $table->decimal('total', 12, 2)->default(0);

            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->decimal('amount_due', 12, 2)->default(0);

            $table->text('notes')->nullable();
            $table->text('terms')->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
