<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ix_sequences', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->string('serie')->nullable();
            $table->string('default_sequence')->nullable();
            $table->unsignedInteger('current_invoice_number')->nullable();
            $table->unsignedInteger('current_invoice_sequence_id')->nullable();
            $table->string('current_invoice_validation_code')->nullable();
            $table->unsignedInteger('current_invoice_receipt_number')->nullable();
            $table->unsignedInteger('current_invoice_receipt_sequence_id')->nullable();
            $table->string('current_invoice_receipt_validation_code')->nullable();
            $table->unsignedInteger('current_simplified_invoice_number')->nullable();
            $table->unsignedInteger('current_simplified_invoice_sequence_id')->nullable();
            $table->string('current_simplified_invoice_validation_code')->nullable();
            $table->unsignedInteger('current_credit_note_number')->nullable();
            $table->unsignedInteger('current_credit_note_sequence_id')->nullable();
            $table->string('current_credit_note_validation_code')->nullable();
            $table->unsignedInteger('current_debit_note_number')->nullable();
            $table->unsignedInteger('current_debit_note_sequence_id')->nullable();
            $table->string('current_debit_note_validation_code')->nullable();
            $table->unsignedInteger('current_receipt_number')->nullable();
            $table->unsignedInteger('current_receipt_sequence_id')->nullable();
            $table->string('current_receipt_validation_code')->nullable();
            $table->unsignedInteger('current_shipping_number')->nullable();
            $table->unsignedInteger('current_shipping_sequence_id')->nullable();
            $table->string('current_shipping_validation_code')->nullable();
            $table->unsignedInteger('current_transport_number')->nullable();
            $table->unsignedInteger('current_transport_sequence_id')->nullable();
            $table->string('current_transport_validation_code')->nullable();
            $table->unsignedInteger('current_devolution_number')->nullable();
            $table->unsignedInteger('current_devolution_sequence_id')->nullable();
            $table->string('current_devolution_validation_code')->nullable();
            $table->unsignedInteger('current_proforma_number')->nullable();
            $table->unsignedInteger('current_proforma_sequence_id')->nullable();
            $table->string('current_proforma_validation_code')->nullable();
            $table->unsignedInteger('current_quote_number')->nullable();
            $table->unsignedInteger('current_quote_sequence_id')->nullable();
            $table->string('current_quote_validation_code')->nullable();
            $table->unsignedInteger('current_fees_note_number')->nullable();
            $table->unsignedInteger('current_fees_note_sequence_id')->nullable();
            $table->string('current_fees_note_validation_code')->nullable();
            $table->unsignedInteger('current_vat_moss_invoice_number')->nullable();
            $table->unsignedInteger('current_vat_moss_invoice_sequence_id')->nullable();
            $table->string('current_vat_moss_invoice_validation_code')->nullable();
            $table->unsignedInteger('current_vat_moss_credit_note_number')->nullable();
            $table->unsignedInteger('current_vat_moss_credit_note_sequence_id')->nullable();
            $table->string('current_vat_moss_credit_note_validation_code')->nullable();
            $table->unsignedInteger('current_vat_moss_receipt_number')->nullable();
            $table->unsignedInteger('current_vat_moss_receipt_sequence_id')->nullable();
            $table->string('current_vat_moss_receipt_validation_code')->nullable();

            $table->timestamps();
        });
    }
};
