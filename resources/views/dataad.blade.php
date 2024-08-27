<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record | Mini Chick</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/resources/css/style.css">
    <style>

    </style>
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
        <div class="add_box d-flex flex-column align-items-center justify-content-center my-3">
            <h1 class="mt-3 mb-2 text-center fw-bold text-dark">Add Data</h1>
            <hr class="w-75 ">
            <div class="add_form w-75 d-flex flex-column align-items-center">
                <form action="/dataadd" method="post" enctype="multipart/form-data" class="w-75 py-2 m-3 border border-2 shadow rounded text-white bg-secondary">
                    @csrf
                    <div class="my-5 mx-2 d-flex flex-column align-items-center justify-content-center">
                        <div class="row w-75">
                            <div class="mb-3 col">
                                <label for="des_img" class="form-label fw-semibold">Design Image</label>
                                <input type="file" class="form-control" id="des_img" name="des_img" accept="image/*" required>
                            </div>
                            <div class="mb-3 col">
                                <label for="des_name" class="form-label fw-semibold">Design Name</label>
                                <input type="text" class="form-control" id="des_name" name="des_name" required>
                            </div>
                        </div>
                        <div class="row w-75">
                            <div class="mb-3 col">
                                <label for="papers" class="form-label fw-semibold">Papers</label>
                                <input type="number" class="form-control" id="papers" name="papers" step="0.01" required>
                            </div>
                            <div class="mb-3 col">
                                <label for="rate" class="form-label fw-semibold">Rate</label>
                                <input type="number" class="form-control" id="rate" name="rate" step="0.01" required>
                            </div>
                        </div>
                        <div class="row w-75">
                            <div class="mb-3 col d-flex">
                                <label for="amount" class="form-label m-auto fw-semibold">Amount :</label>
                                <input type="number" class="form-control border-0 w-50 fw-bold bg-transparent text-white" id="amount" name="amount" step="0.01" readonly required>
                            </div>
                            <div class="sbtn col text-center">
                                <button type="submit" class="btn btn-dark mx-1 fw-semibold">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @if(session('success'))
            <div class="alert alert-success w-100">{{ session('success') }}</div>
            @endif
        </div>
        <div class="row" id="row">
            @if ($latestDesignings->isNotEmpty())
            @foreach ($latestDesignings as $designing)
            <div class="col-md-4 mb-4 d-flex align-items-center justify-content-center">
                <div class="card shadow h-100" id="card{{$designing->id}}" style="max-height: 18rem; overflow:hidden;">
                    <div class="row g-0 w-100 d-flex m-auto align-items-center justify-content-center">
                        <div class="col col-md-6 d-flex justify-content-center p-3" style="max-width: 60%;">
                            <img src="{{ asset('storage/' . $designing->des_img) }}" alt="Design Image" class="img-fluid rounded">
                        </div>
                        <div class="col col-md-6 m-auto" style="max-width: 40%;">
                            <div class="card-body rounded" style="max-height: 18rem; overflow-y: auto;">
                                <h5 class="card-title"><strong>Name:</strong> {{$designing->des_name}}</h5>
                                <p class="card-text my-1"><strong>ID: </strong> {{$designing->id}}</p>
                                <p class="card-text my-1"><strong>Papers: </strong> {{$designing->papers}}</p>
                                <p class="card-text my-1"><strong>Rate: </strong> {{$designing->rate}}</p>
                                <p class="card-text my-1"><strong>Amount:</strong> <strong>{{$designing->amount}}</strong></p>
                                <p class="card-text"><strong>Printer:</strong> {{ $designing->printer_name ?: 'No Printer' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>No records found.</p>
            @endif
        </div>
    </div>
    <script>
        document.getElementById('amount').style.cursor = 'default';
        document.getElementById('amount').addEventListener('focus', function() {
            this.style.outline = 'none';
            this.style.boxShadow = 'none';
        });

        function calculateAmount() {
            var rate = parseFloat(document.getElementById('rate').value) || 0;
            var paper = parseFloat(document.getElementById('papers').value) || 0;
            var amount = rate * paper;
            document.getElementById('amount').value = amount.toFixed(2);
        }

        document.getElementById('rate').addEventListener('input', calculateAmount);
        document.getElementById('paper').addEventListener('input', calculateAmount);
    </script>
</body>

</html>