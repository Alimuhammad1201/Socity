<html>
<head>
    <h1>User Information</h1>
</head>
<body>
<form action="{{ route('processPayment') }}" method="POST" id="payment-form">
    @csrf
    <input type="hidden" name="package_id" value="{{ $subscribe->id }}">
    <label for="name">Name</label>
    <input type="text" name="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" required>

    <!-- Stripe Card Element -->
    <div id="card-element"></div>
    <button type="submit">Pay Rs:{{ $subscribe->price }}</button>
</form>
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_51NdVnELfxADWNbsjVGuDtWlFPeNPyxEzr9FZU9r2r0eij1OjltIG1Z6kAO6KHkcgXCoTMf1e1TLIai2VlX6GcQMn007T1zD3Bd');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const {token, error} = await stripe.createToken(card);

        if (error) {
            console.error(error);
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            form.submit();
        }
    });
</script>
</body>
</html>


{{--@section('scripts')--}}

{{--@endsection--}}
