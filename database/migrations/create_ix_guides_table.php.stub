<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Squarebit\InvoiceXpress\API\Enums\GuideStatusEnum;
use Squarebit\InvoiceXpress\API\Enums\GuideTypeEnum;
use Squarebit\InvoiceXpress\API\Enums\TaxExemptionCodeEnum;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ix_guides', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->enum('type', GuideTypeEnum::values())->nullable();
            $table->enum('status', GuideStatusEnum::values())->nullable();
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
            $table->json('address_from')->nullable();
            $table->json('address_to')->nullable();
            $table->string('at_doc_code_id')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('load_site')->nullable();
            $table->string('delivery_site')->nullable();
            $table->dateTime('loaded_at')->nullable();

            $table->timestamps();
        });
    }
};
