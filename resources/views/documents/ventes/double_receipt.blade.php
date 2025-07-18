<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            font-family: 'Tahoma', Arial, sans-serif !important;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-size: 12px;
            line-height: 1.4;
        }
        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            position: relative;
        }
        .half-page {
            width: 100%;
            height: 50%;
            box-sizing: border-box;
            padding: 15px;
            position: relative;
        }
        .divider {
            border-top: 1px dashed #000;
            text-align: center;
            padding: 5px 0;
            margin: 15px 0;
            position: relative;
        }
        .divider-text {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            padding: 0 10px;
            font-size: 11px;
            color: #666;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #ccc;
        }
        .receipt-header h2 {
            margin: 5px 0;
            font-size: 16px;
        }
        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 12px;
        }
        .receipt-info div {
            margin-bottom: 5px;
        }
        .receipt-info strong {
            font-weight: bold;
        }
        .receipt-footer {
            margin-top: 15px;
            text-align: center;
            font-size: 11px;
            padding-top: 10px;
            border-top: 1px dashed #ccc;
        }
        .receipt-totals {
            margin-top: 10px;
            text-align: right;
        }
        .receipt-totals div {
            margin: 5px 0;
        }
        .receipt-totals .total-line {
            font-weight: bold;
            font-size: 14px;
        }
        .receipt-signature {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            border-top: 1px dotted #000;
            width: 45%;
            padding-top: 5px;
            text-align: center;
            font-size: 11px;
        }
        .receipt-title {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #666;
        }
        @media print {
            .page {
                page-break-after: always;
            }
            .half-page {
                height: 140mm; /* Ajustement pour l'impression */
            }
        }
    </style>
</head>
<body>

@php
    function lignes_table($o_vente){
        $table = '<table style="width: 100%; border-collapse: collapse; margin: 10px 0;">';
        $table.='<thead>
<tr style="border-bottom: 1px solid #ddd;">
    <th style="text-align:left; padding: 5px; font-size: 12px; font-weight: bold;">Art</th>
    <th style="text-align:center; padding: 5px; font-size: 12px; font-weight: bold;">Qte</th>
    <th style="text-align:right; padding: 5px; font-size: 12px; font-weight: bold;">Prix</th>
    <th style="text-align:right; padding: 5px; font-size: 12px; font-weight: bold;">S.Total</th>
</tr>
</thead>';
        foreach ($o_vente->lignes as $ligne){
            $table.= '<tr style="border-bottom: 1px dotted #eee;">
            <td style="padding: 5px; font-size: 11px;">'.$ligne->article->reference.' | '.$ligne->nom_article.'</td>
            <td style="padding: 5px; text-align:center; font-size: 11px;">'.$ligne->quantite.'</td>
            <td style="padding: 5px; text-align:right; font-size: 11px;">'.number_format($ligne->ht,2,'.',' ').'</td>
            <td style="padding: 5px; text-align:right; font-size: 11px;">'.number_format($ligne->quantite * $ligne->ht,2,'.',' ').'</td>
            </tr>';
        }

        $table.= '</table>';
        return $table;
    }

    // Calculate total paid amount from all payments
    $total_paye = 0;
    foreach ($o_vente->paiements as $paiement) {
        $total_paye += $paiement->encaisser;
    }

    // Calculate remaining amount (solde)
    $montant_restant = $o_vente->solde;

    // Get reseller name from authenticated user
    $nom_revendeur = auth()->check() ? auth()->user()->name : 'N/A';

    $functions =[
            '[Date_et_heure]'=>now()->toDateTimeString(),
            '[Tableau]'=> lignes_table($o_vente),
            '[Reference]'=> $o_vente->reference,
            '[Magasin_adresse]'=>$o_vente->magasin->adresse,
            '[Magasin]'=>$o_vente->magasin->nom,
            '[Total_HT]'=>  number_format($o_vente->total_ht + $o_vente->total_reduction,2,'.',' ').' MAD',
            '[Total_TVA]'=>  number_format($o_vente->total_tva,2,'.',' ').' MAD',
            '[Total_TTC]'=>  number_format($o_vente->total_ttc,2,'.',' ').' MAD',
            '[Montant_Paye]'=> number_format($total_paye,2,'.',' ').' MAD',
            '[Montant_Restant]'=> number_format($montant_restant,2,'.',' ').' MAD',
            '[Nom_Revendeur]'=> $nom_revendeur,
        ];
@endphp

<div class="page">
    <!-- Première moitié (Copie client) -->
    <div class="half-page">
        <div class="receipt-title">COPIE CLIENT</div>
        <div class="receipt-header">
            <h2>{!! $o_vente->magasin->nom ?? 'Magasin' !!}</h2>
            <div>{!! $o_vente->magasin->adresse ?? '' !!}</div>
            <div>Référence: {!! $o_vente->reference !!}</div>
            <div>Date: {!! now()->format('d/m/Y H:i') !!}</div>
        </div>

        <div class="receipt-info">
            <div>
                <strong>Client:</strong> {!! $o_vente->client->nom ?? 'Client' !!}
            </div>
            <div>
                <strong>Vendeur:</strong> {!! $nom_revendeur !!}
            </div>
        </div>

        {!! str_replace(array_keys($functions),$functions,$template) !!}

        <div class="receipt-totals">
            <div>Total HT: {!! number_format($o_vente->total_ht + $o_vente->total_reduction,2,'.',' ') !!} MAD</div>
            <div>Total TVA: {!! number_format($o_vente->total_tva,2,'.',' ') !!} MAD</div>
            <div class="total-line">Total TTC: {!! number_format($o_vente->total_ttc,2,'.',' ') !!} MAD</div>
            <div>Montant Payé: {!! number_format($total_paye,2,'.',' ') !!} MAD</div>
            <div>Montant Restant: {!! number_format($montant_restant,2,'.',' ') !!} MAD</div>
        </div>

        <div class="receipt-signature">
            <div class="signature-box">Client</div>
            <div class="signature-box">Vendeur</div>
        </div>

        <div class="receipt-footer">
            Merci pour votre achat!
        </div>
    </div>

    <!-- Séparation -->
    <div class="divider">
        <span class="divider-text">✂ Découper ici ✂</span>
    </div>

    <!-- Deuxième moitié (Copie vendeur) -->
    <div class="half-page">
        <div class="receipt-title">COPIE VENDEUR</div>
        <div class="receipt-header">
            <h2>{!! $o_vente->magasin->nom ?? 'Magasin' !!}</h2>
            <div>{!! $o_vente->magasin->adresse ?? '' !!}</div>
            <div>Référence: {!! $o_vente->reference !!}</div>
            <div>Date: {!! now()->format('d/m/Y H:i') !!}</div>
        </div>

        <div class="receipt-info">
            <div>
                <strong>Client:</strong> {!! $o_vente->client->nom ?? 'Client' !!}
            </div>
            <div>
                <strong>Vendeur:</strong> {!! $nom_revendeur !!}
            </div>
        </div>

        {!! str_replace(array_keys($functions),$functions,$template) !!}

        <div class="receipt-totals">
            <div>Total HT: {!! number_format($o_vente->total_ht + $o_vente->total_reduction,2,'.',' ') !!} MAD</div>
            <div>Total TVA: {!! number_format($o_vente->total_tva,2,'.',' ') !!} MAD</div>
            <div class="total-line">Total TTC: {!! number_format($o_vente->total_ttc,2,'.',' ') !!} MAD</div>
            <div>Montant Payé: {!! number_format($total_paye,2,'.',' ') !!} MAD</div>
            <div>Montant Restant: {!! number_format($montant_restant,2,'.',' ') !!} MAD</div>
        </div>

        <div class="receipt-signature">
            <div class="signature-box">Client</div>
            <div class="signature-box">Vendeur</div>
        </div>

        <div class="receipt-footer">
            Merci pour votre achat!
        </div>
    </div>
</div>

</body>
</html>
