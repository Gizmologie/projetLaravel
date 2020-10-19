@extends('pages.order.base')

@section('process')
    @foreach($order->getLines() as $line)
        <div class="card card-border-none shadow mb-3" id="product-line-{{ $line['product']['id'] }}">
            <div class="card-body p-1">
                <div class="row p-2">
                    <div class="col-3 cart-img-container">
                        <img class="img-fluid my-auto" src="{{ asset($line['product']['image']) }}" alt="{{ $line['product']['name'] }}">
                    </div>
                    <div class="col-5">
                        <h4 class="card-title ">
                            {{ $line['product']['name'] }}
                            @if($line['quantity'] > 1)
                                (x{{ $line['quantity'] }})
                            @endif
                        </h4>

                        <p>
                            {{ $line['product']['price'] }} €
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection()

@section('next')
    <button id="checkout-button" class="btn btn-primary"><i class="fas fa-credit-card"></i> Payer</button>
@endsection

@section('javascript')
    <script src="{{ asset('colissimo-scrapper') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <script type="text/javascript">

        // Create an instance of the Stripe object with your publishable API key

        var stripe = Stripe("{{ $publicKey }}");

        var checkoutButton = document.getElementById("checkout-button");

        checkoutButton.addEventListener("click", function () {

            fetch("{{ route('orderSession') }}", {

                method: "GET",

            })

            .then(function (response) {

                return response.json();

            })

            .then(function (session) {

                return stripe.redirectToCheckout({ sessionId: session.id });

            })

            .then(function (result) {

                // If redirectToCheckout fails due to a browser or network

                // error, you should display the localized error message to your

                // customer using error.message.

                if (result.error) {

                    alert(result.error.message);

                }

            })

            .catch(function (error) {

                console.error("Error:", error);

            });

        });

    </script>
@endsection
