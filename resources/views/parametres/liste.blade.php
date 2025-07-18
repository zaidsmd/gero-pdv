@extends('layouts.main')
@section('document-title')
    Paramètres
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('libs/select2/css/select2.min.css')}}">
    <link href="{{asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/daterangepicker/css/daterangepicker.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('libs/dropify/css/dropify.min.css')}}">
@endpush
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card-title">
                <div class="d-flex switch-filter justify-content-between align-items-center">
                    <h2 class="m-0"><i class="mdi mdi-cog me-2 text-success"></i> Paramètres </h2>
                </div>
                <hr class="border">
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5>General</h5>
                            <hr>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('informations.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-university fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Informations Entreprise
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('references.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-registered fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Références
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('modules.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-file fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Gestion des documents
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('compteurs.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-sort-numeric-down fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Compteurs
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('magasin.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-store fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Magasins
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5>Personnalisation</h5>
                            <hr>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('documents.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-file-pdf fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Mise en page PDF
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('fonctionnalites.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-cogs fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Fonctionnalités
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('pos-settings.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-cash-register fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Point de vente
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('produits-settings.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-boxes fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Produits
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('tableau_bord.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-layer-group fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Tableau de bord
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('abonnementsSettings.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="mdi text-success mdi-repeat  fa-2x "></i>
                                            <h6 class="m-0 mt-2">
                                                Paramétres d'abonnement
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5>Listes</h5>
                            <hr>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('unites.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-shopping-bag fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Unités
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('taxes.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-percent fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Taxes
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('balises.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-tags fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Étiquettes
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('methodes_paiement.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-credit-card fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Méthodes de paiement
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('methodes-livraison.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-truck-loading fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Méthodes de livraison
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('categories.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-wallet fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Catégories de dépense
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('formes_juridique.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-user-tag fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Formes juridique
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('operations.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-file-invoice-dollar fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Opérations bancaires
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('banques.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-dollar-sign fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Banques
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5>Intégration</h5>
                            <hr>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('smtpSettings.modifier')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-envelope-open-text fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Configuration SMTP
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('woocommerce.parametres')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"  version="1.1" viewBox="0 0 256 153" height="39">
                                                <metadata>
                                                    <rdf:RDF>
                                                        <cc:Work rdf:about="">
                                                            <dc:format>image/svg+xml</dc:format>
                                                            <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/>
                                                            <dc:title/>
                                                        </cc:Work>
                                                    </rdf:RDF>
                                                </metadata>
                                                <path d="m23.759 0h208.38c13.187 0 23.863 10.675 23.863 23.863v79.542c0 13.187-10.675 23.863-23.863 23.863h-74.727l10.257 25.118-45.109-25.118h-98.695c-13.187 0-23.863-10.675-23.863-23.863v-79.542c-0.10466-13.083 10.571-23.863 23.758-23.863z" style="fill: var(--bs-success)"/>
                                                <path d="m14.578 21.75c1.4569-1.9772 3.6423-3.0179 6.5561-3.226 5.3073-0.41626 8.3252 2.0813 9.0537 7.4927 3.226 21.75 6.7642 40.169 10.511 55.259l22.79-43.395c2.0813-3.9545 4.6829-6.0358 7.8049-6.2439 4.5789-0.3122 7.3886 2.6016 8.5333 8.7415 2.6016 13.841 5.9317 25.6 9.8862 35.59 2.7057-26.433 7.2846-45.476 13.737-57.236 1.561-2.9138 3.8504-4.3707 6.8683-4.5789 2.3935-0.20813 4.5789 0.52033 6.5561 2.0813 1.9772 1.561 3.0179 3.5382 3.226 5.9317 0.10406 1.8732-0.20813 3.4341-1.0407 4.9951-4.0585 7.4927-7.3886 20.085-10.094 37.567-2.6016 16.963-3.5382 30.179-2.9138 39.649 0.20813 2.6016-0.20813 4.8911-1.2488 6.8683-1.2488 2.2894-3.122 3.5382-5.5154 3.7463-2.7057 0.20813-5.5154-1.0406-8.2211-3.8504-9.678-9.8862-17.379-24.663-22.998-44.332-6.7642 13.32-11.759 23.311-14.985 29.971-6.1398 11.759-11.343 17.795-15.714 18.107-2.8098 0.20813-5.2033-2.1854-7.2846-7.1805-5.3073-13.633-11.031-39.961-17.171-78.985-0.41626-2.7057 0.20813-5.0992 1.665-6.9724zm223.64 16.338c-3.7463-6.5561-9.2618-10.511-16.65-12.072-1.9772-0.41626-3.8504-0.62439-5.6195-0.62439-9.9902 0-18.107 5.2033-24.455 15.61-5.4114 8.8455-8.1171 18.628-8.1171 29.346 0 8.013 1.665 14.881 4.9951 20.605 3.7463 6.5561 9.2618 10.511 16.65 12.072 1.9772 0.41626 3.8504 0.62439 5.6195 0.62439 10.094 0 18.211-5.2033 24.455-15.61 5.4114-8.9496 8.1171-18.732 8.1171-29.45 0.10406-8.1171-1.665-14.881-4.9951-20.501zm-13.112 28.826c-1.4569 6.8683-4.0585 11.967-7.9089 15.402-3.0179 2.7057-5.8276 3.8504-8.4293 3.3301-2.4976-0.52033-4.5789-2.7057-6.1398-6.7642-1.2488-3.226-1.8732-6.452-1.8732-9.4699 0-2.6016 0.20813-5.2033 0.72846-7.5967 0.93659-4.2667 2.7057-8.4293 5.5154-12.384 3.4341-5.0992 7.0764-7.1805 10.823-6.452 2.4976 0.52033 4.5789 2.7057 6.1398 6.7642 1.2488 3.226 1.8732 6.452 1.8732 9.4699 0 2.7057-0.20813 5.3073-0.72846 7.7008zm-52.033-28.826c-3.7463-6.5561-9.3659-10.511-16.65-12.072-1.9772-0.41626-3.8504-0.62439-5.6195-0.62439-9.9902 0-18.107 5.2033-24.455 15.61-5.4114 8.8455-8.1171 18.628-8.1171 29.346 0 8.013 1.665 14.881 4.9951 20.605 3.7463 6.5561 9.2618 10.511 16.65 12.072 1.9772 0.41626 3.8504 0.62439 5.6195 0.62439 10.094 0 18.211-5.2033 24.455-15.61 5.4114-8.9496 8.1171-18.732 8.1171-29.45 0-8.1171-1.665-14.881-4.9951-20.501zm-13.216 28.826c-1.4569 6.8683-4.0585 11.967-7.9089 15.402-3.0179 2.7057-5.8276 3.8504-8.4293 3.3301-2.4976-0.52033-4.5789-2.7057-6.1398-6.7642-1.2488-3.226-1.8732-6.452-1.8732-9.4699 0-2.6016 0.20813-5.2033 0.72846-7.5967 0.93658-4.2667 2.7057-8.4293 5.5154-12.384 3.4341-5.0992 7.0764-7.1805 10.823-6.452 2.4976 0.52033 4.5789 2.7057 6.1398 6.7642 1.2488 3.226 1.8732 6.452 1.8732 9.4699 0.10406 2.7057-0.20813 5.3073-0.72846 7.7008z" fill="#fff"/>
                                            </svg>
                                            <h6 class="m-0 mt-2">
                                                Configuration Woocommerce
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <h5>Communication</h5>
                            <hr>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <a href="{{route('relance.liste')}}">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <i class="fa text-success fa-paper-plane fa-3x"></i>
                                            <h6 class="m-0 mt-2">
                                                Paramétres de relance
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
