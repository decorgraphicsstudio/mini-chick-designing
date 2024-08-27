<!-- resources/views/payments/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/resources/css/style.css">
</head>

<body class="bg-secondary-subtle">
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 text-light" href="/">Mini Chick</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-2 px-1">
                        <a class="nav-link fs-5 text-light" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item mx-2 px-1">
                        <a class="nav-link fs-5 text-light" aria-current="page" href="/dataadd">Add Data</a>
                    </li>
                    <li class="nav-item mx-2 px-1">
                        <a class="nav-link fs-5 text-light" href="/payment-form">Add Payment</a>
                    </li>
                    <li class="nav-item mx-2 px-1">
                        <a class="nav-link fs-5 text-light" href="/printer">Add Printer</a>
                    </li>
                    <li class="nav-item mx-2 px-1">
                        <a class="nav-link fs-5 text-light" href="/showdata">Search Data</a>
                    </li>
                    <li class="nav-item mx-2 px-1">
                        <a class="nav-link fs-5 text-light" href="/payments">View Payments</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 class="mt-5 mb-4 text-center fw-bold text-dark">View Payments</h1>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th class="bg-secondary-subtle">ID</th>
                    <th class="bg-secondary-subtle">Payment Date</th>
                    <th class="bg-secondary-subtle">Payment Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td class="bg-secondary-subtle">{{ $payment->id }}</td>
                    <td class="bg-secondary-subtle">{{ $payment->payment_date }}</td>
                    <td class="bg-secondary-subtle"><strong>{{ number_format($payment->payment_amount, 2) }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>