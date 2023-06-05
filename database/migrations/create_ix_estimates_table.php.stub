<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Squarebit\InvoiceXpress\API\Enums\EstimateStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\EstimateTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ix_estimates', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->enum('type', EstimateTypeEnum::values())->nullable();
            $table->enum('status', EstimateStatusEnum::values())->nullable();
            $table->boolean('archived')->nullable();
            $table->string('sequence_number')->nullable();
            $table->string('inverted_sequence_number')->nullable();
            $table->string('manual_sequence_number')->nullable();
            $table->string('atcud')->nullable();
            $table->string('sequence_id')->nullable();
            $table->enum('tax_exemption', TaxExemptionCodeEnum::values())->nullable();
            $table->enum('tax_exemption_reason', TaxExemptionCodeEnum::values())->nullable();
            $table->date('date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('reference')->nullable();
            $table->string('observations')->nullable();
            $table->string('retention')->nullable();
            $table->string('permalink')->nullable();
            $table->string('saft_hash')->nullable();
            $table->float('sum')->nullable();
            $table->float('discount')->nullable();
            $table->float('before_taxes')->nullable();
            $table->float('taxes')->nullable();
            $table->float('total')->nullable();
            $table->string('currency')->nullable();
            $table->json('client')->nullable();
            $table->json('items')->nullable();
            $table->json('mb_reference')->nullable();
            $table->boolean('auto_add_related_document')->nullable();

            $table->timestamps();
        });
    }
};
