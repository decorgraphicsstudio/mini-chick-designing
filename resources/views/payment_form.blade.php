<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
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
        <div class="add_box d-flex flex-column align-items-center justify-content-center">
            <h1 class="mt-5 mb-4 text-center fw-bold text-dark">Add Payment</h1>
            <hr class="w-75 ">
            <div class="add_form w-75 d-flex flex-column align-items-center">
                <form action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data" class="w-75 py-5 m-5 border border-2 border-white shadow rounded bg-secondary text-white">
                    @csrf
                    <div class="my-5 mx-2 d-flex flex-column align-items-center justify-content-center">
                        <div class="row w-75">
                            <div class="mb-3 col">
                                <label for="paymentDate" class="form-label fw-semibold">Payment Date:</label>
                                <input type="date" class="form-control" id="paymentDate" name="paymentDate" required>
                            </div>
                            <div class="mb-3 col">
                                <label for="paymentAmount" class="form-label fw-semibold">Payment Amount</label>
                                <input type="number" class="form-control" id="paymentAmount" name="paymentAmount" step="0.01" required>
                            </div>
                            <div class="row w-75 ms-auto mt-2">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-dark mx-1 fw-semibold">Add Payment</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            @if(session('success'))
            <div class="alert alert-success w-100">{{ session('success') }}</div>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('paymentDate').setAttribute('max', today);
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>