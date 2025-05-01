<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Checkout</h4>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <h5>Order Summary</h5>
                        <hr>
                        <p>Product: Example Product</p>
                        <p>Price: $100.00</p>

                        <hr>
                        <form action="{{ route('payWithPaypal') }}" method="POST">
                            @csrf
                            <input type="text" name="amount" placeholder="Enter amount">
                            <button type="submit" class="btn btn-primary btn-block">
                                Pay with PayPal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
