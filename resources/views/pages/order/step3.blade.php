@extends('pages.order.base')

@section('process')
    <div class="row pt-5 mt-5">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-header bg-transparent border-bottom-0">
                    <span class="success-badge"><i class="fas fa-2x fa-check mt-2"></i></span>
                </div>
                <div class="card-body ">
                    <h4 class="text-center">Votre commande a été enregistrée</h4>
                    <p class="pt-3">
                        Vous pouvez suivre son évolution depuis votre espace mes commandes. Vous serez
                        également notifié par mail des changements.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            @include('components.order.delivery_state')
        </div>
    </div>
@endsection()
