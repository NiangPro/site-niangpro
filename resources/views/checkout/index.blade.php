@extends('layouts.master')

@section('title')
    Paiement
@endsection

@section('extra-meta')
    <meta name="csrf-token" content=" {{ csrf_token() }}">
@endsection

@section('extra-script')
<script src="{{ asset('https://js.stripe.com/v3/') }}"></script>
@endsection

@section('content')
    <div class="container mt-5">
        <h2>Page de paiement</h2>
        <div class="row">
            <div class="col-md-6">
                <form id="payment-form">
                    <div id="card-element">
                        <!-- Elements will create input elements here -->
                    </div>

                    <!-- We'll put the error messages in this element -->
                    <div id="card-errors" role="alert"></div>

                    <button id="submit" class="btn btn-outline-success">Payer</button>
                </form>

            </div>
            <div class="col-md-6">  </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        // Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
var stripe = Stripe('pk_test_51HNVghDvpK43F8S91uZanBFNpfDBuaH9th1x5ZR4wa5yuI07tF9m9Vb9Hb9Q4X7ZGVBLd4eN5AabRzOXtPebGiiJ00282jGwoK');
// Set up Stripe.js and Elements to use in checkout form
var elements = stripe.elements();
var style = {
  base: {
    color: "#32325d",
  }
};

var card = elements.create("card", { style: style });
card.mount("#card-element");
card.on('change', ({error}) => {
  const displayError = document.getElementById('card-errors');
  if (error) {
    displayError.textContent = error.message;
  } else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');

form.addEventListener('submit', function(ev) {
  ev.preventDefault();
  stripe.confirmCardPayment(clientSecret, {
    payment_method: {
      card: card,
      billing_details: {
        name: 'Jenny Rosen'
      }
    }
  }).then(function(result) {
    if (result.error) {
      // Show error to your customer (e.g., insufficient funds)
      console.log(result.error.message);
    } else {
      // The payment has been processed!
      if (result.paymentIntent.status === 'succeeded') {
        // Show a success message to your customer
        // There's a risk of the customer closing the window before callback
        // execution. Set up a webhook or plugin to listen for the
        // payment_intent.succeeded event that handles any business critical
        // post-payment actions.
      }
    }
  });
});

    </script>
@endsection
