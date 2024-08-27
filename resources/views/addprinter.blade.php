<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Printer | Mini Chick</title>
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
            <h1 class="mt-5 mb-4 text-center fw-bold text-dark">Add Printer</h1>
            <hr class="w-75 ">
            <div class="add_form w-75 d-flex flex-column align-items-center">
                <form action="/addprinter" method="post" enctype="multipart/form-data" class="w-75 py-5 m-5 border border-2 shadow rounded text-white bg-secondary">
                    @csrf
                    <div class="my-5 mx-2 d-flex flex-column align-items-center justify-content-center">
                        <div class="row w-75">
                            <div class="mb-3 col">
                                <label for="printer_name" class="form-label fw-semibold">Printer Name</label>
                                <input type="text" class="form-control" id="printer_name" name="printer_name" required>
                            </div>
                            <div class="mb-3 col">
                                <label for="design_id" class="form-label fw-semibold">Design ID</label>
                                <input type="number" class="form-control" id="design_id" name="design_id" required>
                            </div>
                        </div>
                        <div class="row w-75">
                            <div class="mb-3 col d-flex">
                                <label for="design_name" class="form-label m-auto fw-semibold">Design Name :</label>
                                <input type="text" class="form-control border-0 w-50 fw-bold bg-transparent text-white" id="design_name" name="design_name" step="0.01" readonly required>
                            </div>
                            <div class="sbtn col text-center">
                                <button type="submit" class="btn btn-dark mx-1 fw-semibold">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success w-100">{{ session('success') }}</div>
            @endif
            <div class="row w-100" id="row">
                <div class="col-md-4 mb-4 d-flex align-items-center justify-content-center mx-auto">
                    <div id="designCard" class="card shadow h-100" style="max-height: 18rem; overflow:hidden;">
                        <div class="row g-0 w-100 d-flex m-auto align-items-center justify-content-center">
                            <div class="col col-md-6 d-flex justify-content-center p-3" style="max-width: 60%;">
                                <img id="dimg" src="" alt="Design Image" class="img-fluid rounded">
                            </div>
                            <div class="col col-md-6 m-auto" style="max-width: 40%;">
                                <div class="card-body rounded" style="max-height: 18rem; overflow-y: auto;">
                                    <h5 class="card-title"><strong>Name: </strong><span id="dname"></span></h5>
                                    <p class="card-text my-1"><strong>ID: </strong><span id="did"></span></p>
                                    <p class="card-text my-1"><strong>Papers: </strong><span id="dpaper"></span></p>
                                    <p class="card-text my-1"><strong>Rate: </strong><span id="drate"></span></p>
                                    <p class="card-text my-1"><strong>Amount:</strong> <strong id="damount"></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('design_name').style.cursor = 'default';
        document.getElementById('design_name').addEventListener('focus', function() {
            this.style.outline = 'none';
            this.style.boxShadow = 'none';
        });

        $('#designCard').hide();

        $(document).ready(function() {
            $('#design_id').on('input', function() {
                var designId = $(this).val();

                if (designId) {
                    $.ajax({
                        url: '/designname',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // Ensures CSRF protection
                            design_id: designId
                        },
                        success: function(response) {
                            if (response.design) {
                                $('#designCard').show();
                                // Populate the card with design details
                                $('#design_name').val(response.design.des_name);
                                $('#did').text(response.design.id);
                                $('#dname').text(response.design.des_name);
                                $('#dpaper').text(response.design.papers);
                                $('#drate').text(response.design.rate);
                                $('#damount').text(response.design.amount);

                                if (response.image) {
                                    $('#dimg').attr('src', response.image).show();
                                } else {
                                    $('#dimg').attr('src', '').hide();
                                }
                            } else {
                                $('#design_name').val('Design not found');
                                $('#designCard').hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                            $('#design_name').val('Error fetching design');
                            $('#designCard').hide();
                        }
                    });
                } else {
                    $('#design_name').val('');
                    $('#designCard').hide();
                }
            });
        });
    </script>
</body>

</html>