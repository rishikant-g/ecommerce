@extends('layouts.app-shop')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
@section('content')
<div id="paypal-button"></div>
@endsection


@section('javascript')
<script>
  paypal.Button.render({
    env: 'sandbox', // Or 'production'

    style: {
        size: 'large',
        color: 'gold',
        shape: 'pill'
    },
    // Set up the payment:
    // 1. Add a payment callback
    payment: function(data, actions) {
      // 2. Make a request to your server
      return actions.request.post('/api/create-payment')
        .then(function(res) {
          // 3. Return res.id from the response
          return res.id;
        });
    },
    // Execute the payment:
    // 1. Add an onAuthorize callback
    onAuthorize: function(data, actions) {
      // 2. Make a request to your server
      return actions.request.post('/api/execute-payment', {
        paymentID: data.paymentID,
        payerID:   data.payerID
      })
        .then(function(res) {
          // 3. Show the buyer a confirmation message.
        });
    }
  }, '#paypal-button');
</script>
@endsection