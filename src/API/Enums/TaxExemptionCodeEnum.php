<?php

namespace Squarebit\InvoiceXpress\API\Enums;

use Squarebit\InvoiceXpress\Concerns\EnumEnhancements;

enum TaxExemptionCodeEnum: string
{
    use EnumEnhancements;

    case M00 = 'Sem isenção';
    case M01 = 'Artigo 16º, n.º 6 do CIVA';
    case M02 = 'Artigo 6º do Decreto-Lei n.º 198/90, de 19 de junho';
    case M04 = 'Isento artigo 13º do CIVA';
    case M05 = 'Isento artigo 14º do CIVA';
    case M06 = 'Isento artigo 15º do CIVA';
    case M07 = 'Isento artigo 9º do CIVA';
    case M09 = 'IVA - não confere direito a dedução';
    case M10 = 'IVA – regime de isenção';
    case M11 = 'Regime particular do tabaco';
    case M12 = 'Regime da margem de lucro – Agências de viagens';
    case M13 = 'Regime da margem de lucro – Bens em segunda mão';
    case M14 = 'Regime da margem de lucro – Objetos de arte';
    case M15 = 'Regime da margem de lucro – Objetos de coleção e antiguidades';
    case M16 = 'Isento Artigo 14º do RITI';
    case M19 = 'Outras isenções';
    case M20 = 'IVA - regime forfetário';
    case M21 = 'IVA – não confere direito à dedução (ou expressão similar)';
    case M25 = 'Mercadorias à consignação';
    case M26 = 'Isenção de IVA com direito à dedução no cabaz alimenta';
    case M30 = 'IVA - autoliquidação - Artigo 2º n.º 1 alínea i) do CIVA';
    case M31 = 'IVA - autoliquidação - Artigo 2º n.º 1 alínea j) do CIVA';
    case M32 = 'IVA - autoliquidação - Artigo 2º n.º 1 alínea l) do CIVA';
    case M33 = 'IVA - autoliquidação - Artigo 2º n.º 1 alínea m) do CIVA';
    case M34 = 'IVA - autoliquidação - Artigo 2º n.º 1 alínea n) do CIV';
    case M40 = 'IVA - autoliquidação - Artigo 6º n.º 6 alínea a) do CIVA, a contrário';
    case M41 = 'IVA - autoliquidação - Artigo 8º n.º 3 do RITI';
    case M42 = 'IVA - autoliquidação - Decreto-Lei n.º 21/2007, de 29 de janeiro';
    case M43 = 'IVA - autoliquidação - Decreto-Lei n.º 362/99, de 16 de setembro';
    case M99 = 'Não sujeito ou não tributado.';
}
