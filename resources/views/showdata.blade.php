<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Record | Mini Chick</title>
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
        <div class="total text-center">
            <h1 class="mt-3 text-center fw-bold text-dark">TOTAL</h1>
            <table class="table mb-4">
                <thead>
                    <tr>
                        <th scope="col" class="bg-secondary-subtle">Papers</th>
                        <th scope="col" class="bg-secondary-subtle">Amount</th>
                        <th scope="col" class="bg-secondary-subtle">Payment</th>
                        <th scope="col" class="bg-secondary-subtle">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="papers" class="bg-secondary text-white fw-semibold rounded-start">{{ $totalPapers }}</td>
                        <td id="amount" class="bg-secondary text-white fw-semibold ">{{ number_format($totalAmount ?? 0, 2) }}</td>
                        <td id="payment" class="bg-secondary text-white fw-semibold ">{{ number_format($totalPay ?? 0, 2) }}</td>
                        <td id="balance" class="bg-secondary fw-semibold rounded-end {{ $balance < 0 ? 'text-danger' : '' }}">{{ number_format($balance ?? 0, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row" id="row">
            @foreach($data as $item)
            <div class="col-md-4 mb-4 d-flex align-items-center justify-content-center">
                <div class="card shadow h-100" id="card{{$item->id}}" style="max-height: 18rem; overflow:hidden;">
                    <div class="row g-0 w-100 d-flex m-auto align-items-center justify-content-center">
                        <div class="col col-md-6 d-flex justify-content-center p-3" style="max-width: 60%;">
                            <img src="{{ asset('storage/' . $item->des_img) }}" alt="Design Image" class="img-fluid rounded">
                        </div>
                        <div class="col col-md-6 m-auto" style="max-width: 40%;">
                            <div class="card-body rounded" style="max-height: 18rem; overflow-y: auto;">
                                <h5 class="card-title"><strong>Name:</strong> {{$item->des_name}}</h5>
                                <p class="card-text my-1"><strong>ID: </strong> {{$item->id}}</p>
                                <p class="card-text my-1"><strong>Papers: </strong> {{$item->papers}}</p>
                                <p class="card-text my-1"><strong>Rate: </strong> {{$item->rate}}</p>
                                <p class="card-text my-1"><strong>Amount:</strong> <strong>{{$item->amount}}</strong></p>
                                <p class="card-text"><strong>Printer:</strong> {{ $item->printer_name ?: 'No Printer' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script>
        function updateBalanceColor() {
            const balanceElement = document.getElementById('balance');
            const balanceText = balanceElement.textContent.trim();
            const balanceValue = parseFloat(balanceText.replace(/[^0-9.-]/g, ''));
            if (balanceValue < 0) {
                balanceElement.style.color = 'red';
                balanceElement.style.backgroundColor = 'white';
            } else {
                balanceElement.style.color = 'white';
            }
        }
        document.getElementById('papers').style.cursor = "pointer";
        document.getElementById('amount').style.cursor = "pointer";
        document.getElementById('payment').style.cursor = "pointer";
        document.getElementById('balance').style.cursor = "pointer";
        document.addEventListener('DOMContentLoaded', updateBalanceColor);
        document.getElementById('row').style.height = '66vh';
        document.getElementById('row').style.overflow = 'scroll';
        document.getElementById('row').style.overflowX = 'hidden';
        // Create a <style> element
        const style = document.createElement('style');
        style.type = 'text/css';

        // Define CSS rules for custom scrollbars
        const css = `
        /* WebKit Browsers */
        ::-webkit-scrollbar {
            width: 7px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #6c757d;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
            border-radius: 10px;
        }

        `;

        // Add the CSS rules to the <style> element
        style.appendChild(document.createTextNode(css));

        // Append the <style> element to the document head
        document.head.appendChild(style);
    </script>
</body>

</html>