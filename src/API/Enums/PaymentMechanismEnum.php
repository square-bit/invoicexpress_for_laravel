<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum PaymentMechanismEnum: string
{
    use EnumEnhancements;

    case TB = 'Transferência bancária ou débito direto autorizado';
    case MB = 'Referências de pagamento para Multibanco';
    case CC = 'Cartão de crédito';
    case CD = 'Cartão de débito';
    case CH = 'Cheque bancário';
    case CO = 'Cheque ou cartão oferta';
    case CS = 'Compensação de saldos de conta corrente';
    case DE = 'Dinheiro electrónico';
    case LC = 'Letra comercial';
    case NU = 'Numerário';
    case PR = 'Permuta de bens';
    case TR = 'Ticket restaurante';
    case CI = 'Crédito documentário internacional';
    case OU = 'Outros meios aqui não assinalados';
}
