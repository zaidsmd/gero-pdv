<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reference' => 'required|unique:clients,reference',
            'forme_juridique' => ['required',Rule::exists('forme_juridique', 'id')],
            'nom' => 'required|string|min:3|max:100',
            'ice' => 'nullable|numeric|digits:15',
            'email' => 'nullable|email',
            'telephone' => ["nullable", "string", "regex:/^(((00|\+)212)|(0))(6|7|8|5)[0-9]{8}$/"],
            'note' => 'nullable|string|max:900',
            'adresse' => 'nullable|string|max:255',
            'limite_de_credit' => 'nullable|numeric|min:0|max:9999999.99',
            'limite_ventes_impayees' => 'nullable|integer|min:0'
        ];
    }

    public function attributes()
    {
        $attributes = [
            'reference' => 'référence',
            'ice' => 'ICE',
            'nom' => in_array($this->get('forme_juridique'), ['sa', 'sarl']) ? 'Dénomination' : 'Dénomination',
            'forme_juridique' => 'forme juridique',
            'email' => 'email',
            'telephone' => 'téléphone',
            'note' => 'note',
            'limite_de_credit' => 'limite de credit',
            'limite_ventes_impayees' => 'limite de ventes impayées',
            'adresse' => 'adresse',
        ];
        return $attributes;
    }

    public function messages()
    {
        return [
            'telephone.regex' => "Le format du numéro de téléphone est invalide, veuillez utiliser l'un de ces formats:\r
                                    - 0612345678
                                    - 0021212345678
                                    - +21212345678"
        ];
    }
}
