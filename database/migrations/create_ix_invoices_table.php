<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Squarebit\InvoiceXpress\API\Enums\InvoiceStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\InvoiceTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ix_invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->enum('type', InvoiceTypeEnum::values())->nullable();
            $table->enum('status', InvoiceStatusEnum::values())->nullable();
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
            $table->float('rate')->nullable();
            $table->string('currency_code')->nullable();
            $table->unsignedInteger('owner_invoice_id')->nullable();

            $table->timestamps();
        });
    }
};
