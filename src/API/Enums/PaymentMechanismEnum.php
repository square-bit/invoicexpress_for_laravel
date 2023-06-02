<?php
/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\API\Enums\Concerns\EnumEnhancements;

enum PaymentMechanismEnum: string
{
    use EnumEnhancements;

    case TB = 'TB';
    case MB = 'MB';
    case CC = 'CC';
    case CD = 'CD';
    case CH = 'CH';
    case CO = 'CO';
    case CS = 'CS';
    case DE = 'DE';
    case LC = 'LC';
    case NU = 'NU';
    case PR = 'PR';
    case TR = 'TR';
    case CI = 'CI';
    case OU = 'OU';

    public function label(): string
    {
        return match ($this) {
            self::TB => 'Transferência bancária ou débito direto autorizado',
            self::MB => 'Referências de pagamento para Multibanco',
            self::CC => 'Cartão de crédito',
            self::CD => 'Cartão de débito',
            self::CH => 'Cheque bancário',
            self::CO => 'Cheque ou cartão oferta',
            self::CS => 'Compensação de saldos de conta corrente',
            self::DE => 'Dinheiro electrónico',
            self::LC => 'Letra comercial',
            self::NU => 'Numerário',
            self::PR => 'Permuta de bens',
            self::TR => 'Ticket restaurante',
            self::CI => 'Crédito documentário internacional',
            self::OU => 'Outros meios aqui não assinalados',
        };
    }
}
