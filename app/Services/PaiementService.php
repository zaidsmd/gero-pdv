<?php

namespace App\Services;

use App\Models\Achat;
use App\Models\Depense;
use App\Models\Paiement;
use App\Models\Vente;
use Carbon\Carbon;
use DB;
use Exception;

class PaiementService
{
    public static function add_paiement(string $payable, int $payable_id, array $data, int $magasin_id = null, int $pos_session_id = null)
    {
        $o_payable = $payable::find($payable_id);
        $date_permission = !request()->user()->can('paiement.date');
        $encaissement_types = ModuleService::getEncaissementTypes();
        $decaissment_types = ModuleService::getDecaissementTypes();
        $payment_data = [
            'payable_type' => $payable,
            'payable_id' => $payable_id,
            'date_paiement' => $date_permission ? Carbon::today()->toDateString() :  Carbon::createFromFormat('d/m/Y', $data['i_date_paiement'])->toDateString(),
            'compte_id' => $data['i_compte_id'],
            'methode_paiement_key' => $data['i_method_key'],
            'note' => $data['i_note'] ?? null,
            'pos_session_id' => $pos_session_id,
            'magasin_id' => $magasin_id,
            'created_by' =>auth()->user()->id,
        ];

        if (in_array($o_payable->type_document, $decaissment_types)) {
            $payment_data['decaisser'] = $data['i_montant'];
        } elseif (in_array($o_payable->type_document, $encaissement_types)) {
            $payment_data['encaisser'] = $data['i_montant'];
        }

        if (in_array($payable, [Achat::class])) {
            $payment_data['fournisseur_id'] = $o_payable->fournisseur_id;
        } elseif (in_array($payable, [Vente::class])) {
            $payment_data['client_id'] = $o_payable->client_id;
        }

        if (in_array($data['i_method_key'], ['cheque', 'lcn'])) {
            if (isset($data['i_reference'])) {
                $payment_data['cheque_lcn_reference'] = $data['i_reference'];
            }

            if (isset($data['i_date'])) {
                $payment_data['cheque_lcn_date'] = Carbon::createFromFormat('d/m/Y', $data['i_date'])->toDateString();
            }
        }


        if (in_array($payable, [Vente::class])) {
            $payable_data['solde'] = $o_payable->solde - $data['i_montant'];
            $payable_data['encaisser'] = $o_payable->encaisser + $data['i_montant'];
            $total = $o_payable->total_ttc;
            $payable_data['statut_paiement'] = self::get_payable_statut($total, $payable_data['encaisser'], $payable_data['solde']);
        } elseif (in_array($payable, [Achat::class])) {
            $payable_data['debit'] = $o_payable->debit - $data['i_montant'];
            $payable_data['credit'] = $o_payable->credit + $data['i_montant'];
            $payable_data['statut_paiement'] = self::get_payable_statut($o_payable->total_ttc, $payable_data['credit'], $payable_data['debit']);
        }

        DB::beginTransaction();
        try {
            if (in_array($o_payable->type_document, [...$decaissment_types, ...$encaissement_types])) {
                $o_payable->update($payable_data);
            }
            Paiement::create($payment_data);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            LogService::logException($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    public static function payer_depense(int $id, array $data, int $magasin_id = null)
    {
        $o_depense = Depense::findOrFail($id);
        $date_permission = !request()->user()->can('paiement.date');
        $payment_data = [
            'payable_type' => Depense::class,
            'payable_id' => $id,
            'date_paiement' => $date_permission ? Carbon::today()->toDateString() : Carbon::createFromFormat('d/m/Y', $data['i_date_paiement'])->toDateString(),
            'compte_id' => $data['i_compte_id'],
            'methode_paiement_key' => $data['i_method_key'],
            'decaisser' => $data['i_montant'],
            'note'=>$data['i_note'],
            'magasin_id' => $magasin_id,
            'created_by' => auth()->user()->id,
        ];

        if (in_array($data['i_method_key'], ['cheque', 'lcn'])) {
            $payment_data['cheque_lcn_reference'] = $data['i_reference'];
            $payment_data['cheque_lcn_date'] = Carbon::createFromFormat('d/m/Y', $data['i_date'])->toDateString();
        }

        $payable_data['solde'] = $o_depense->solde - $data['i_montant'];
        $payable_data['encaisser'] = $o_depense->encaisser + $data['i_montant'];
        $total = $o_depense->montant;
        $payable_data['statut_paiement'] = self::get_payable_statut($total, $payable_data['encaisser'], $payable_data['solde']);

        $o_depense->update($payable_data);
        DB::beginTransaction();
        try {
            Paiement::create($payment_data);
            DB::commit();
            return true;
        } catch (Exception $exception) {
            LogService::logException($exception);
            DB::rollBack();
            throw $exception;
        }
    }

    public static function get_payable_statut(float|string $payable_total, float|string $montant_paye = 0, float|string $montant_impaye = 0)
    {
        if ($montant_impaye <= 0 && round($montant_paye, 2) >= round($payable_total, 2)) {
            $paiment_statut = 'paye';
        } elseif ($montant_paye > 0 && round($payable_total, 2) > round($montant_paye, 2)) {
            $paiment_statut = 'partiellement_paye';
        } else {
            $paiment_statut = 'non_paye';
        }
        return $paiment_statut;
    }
}
