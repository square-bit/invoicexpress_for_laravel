<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Squarebit\InvoiceXpress\Enums\IXClientLanguageEnum;
use Squarebit\InvoiceXpress\Enums\IXClientSendOptionsEnum;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ix_clients', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->string('name'); // 'Ricardo Pereira'
            $table->string('code')->nullable(); // 'TEST_RP'
            $table->enum('language', IXClientLanguageEnum::values())->nullable(); // 'pt'
            $table->string('email')->nullable(); // 'someone@example.com'
            $table->string('address')->nullable(); // 'Lisbon'
            $table->string('city')->nullable(); // 'Lisbon'
            $table->string('postal_code')->nullable(); // '1750-455'
            $table->string('fiscal_id')->nullable(); // '508025338'
            $table->string('website')->nullable(); // 'www.invoicexpress.com'
            $table->string('country')->nullable(); // 'Portugal'
            $table->string('phone')->nullable(); // '2313423424'
            $table->string('fax')->nullable(); // '2313423425'
            $table->json('preferred_contact')->nullable();
            //    'preferred_contact': {
            //      'name': 'Ricardo Pereira',
            //      'email': 'someone_2@example.com',
            //      'phone': '2233442233'
            //    },
            $table->string('observations')->nullable(); // 'Observations'
            $table->enum('send_options', IXClientSendOptionsEnum::values())->nullable(); // 1
            $table->string('payment_days')->nullable(); // '0'
            $table->string('tax_exemption_code')->nullable(); // 'M00

            $table->timestamps();
        });
    }
};
