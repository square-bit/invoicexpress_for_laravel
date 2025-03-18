<?php

/**
 * Copyright (c) 2023.  - open-sourced software licensed under the MIT license.
 * Squarebit, Lda - Portugal - www.square-bit.com
 */

namespace Squarebit\InvoiceXpress\Enums;

use Squarebit\InvoiceXpress\Enums\Concerns\EnumEnhancements;

enum TaxExemptionCodeEnum: string
{
    use EnumEnhancements;

    case M00 = 'M00';
    case M01 = 'M01';
    case M02 = 'M02';
    case M04 = 'M04';
    case M05 = 'M05';
    case M06 = 'M06';
    case M07 = 'M07';
    case M09 = 'M09';
    case M10 = 'M10';
    case M11 = 'M11';
    case M12 = 'M12';
    case M13 = 'M13';
    case M14 = 'M14';
    case M15 = 'M15';
    case M16 = 'M16';
    case M19 = 'M19';
    case M20 = 'M20';
    case M21 = 'M21';
    case M25 = 'M25';
    case M26 = 'M26';
    case M30 = 'M30';
    case M31 = 'M31';
    case M32 = 'M32';
    case M33 = 'M33';
    case M34 = 'M34';
    case M40 = 'M40';
    case M41 = 'M41';
    case M42 = 'M42';
    case M43 = 'M43';
    case M99 = 'M99';

    public function label(): string
    {
        return match ($this) {
            self::M00 => 'Sem isenção.',
            self::M01 => 'Artigo 16º, n.º 6 do CIVA.',
            self::M02 => 'Artigo 6º do Decreto-Lei n.º 198/90, de 19 de junho.',
            self::M04 => 'Isento artigo 13º do CIVA.',
            self::M05 => 'Isento artigo 14º do CIVA.',
            self::M06 => 'Isento artigo 15º do CIVA.',
            self::M07 => 'Isento artigo 9º do CIVA.',
            self::M09 => 'IVA - não confere direito a dedução.',
            self::M10 => 'IVA – regime de isenção.',
            self::M11 => 'Regime particular do tabaco.',
            self::M12 => 'Regime da margem de lucro – Agências de viagens.',
            self::M13 => 'Regime da margem de lucro – Bens em segunda mão.',
            self::M14 => 'Regime da margem de lucro – Objetos de arte.',
            self::M15 => 'Regime da margem de lucro – Objetos de coleção e antiguidades.',
            self::M16 => 'Isento Artigo 14º do RITI.',
            self::M19 => 'Outras isenções.',
            self::M20 => 'IVA - regime forfetário.',
            self::M21 => 'IVA – não confere direito à dedução (ou expressão similar).',
            self::M25 => 'Mercadorias à consignação.',
            self::M26 => 'Isenção de IVA com direito à dedução no cabaz alimenta.',
            self::M30 => 'IVA - autoliquidação - Artigo 2º n.º 1 alínea i) do CIVA.',
            self::M31 => 'IVA - autoliquidação - Artigo 2º n.º 1 alínea j) do CIVA.',
            self::M32 => 'IVA - autoliquidação - Artigo 2º n.º 1 alínea l) do CIVA.',
            self::M33 => 'IVA - autoliquidação - Artigo 2º n.º 1 alínea m) do CIVA.',
            self::M34 => 'IVA - autoliquidação - Artigo 2º n.º 1 alínea n) do CIV.',
            self::M40 => 'IVA - autoliquidação - Artigo 6º n.º 6 alínea a) do CIVA, a contrário.',
            self::M41 => 'IVA - autoliquidação - Artigo 8º n.º 3 do RITI.',
            self::M42 => 'IVA - autoliquidação - Decreto-Lei n.º 21/2007, de 29 de janeiro.',
            self::M43 => 'IVA - autoliquidação - Decreto-Lei n.º 362/99, de 16 de setembro.',
            self::M99 => 'Não sujeito ou não tributado.',
        };
    }
}
