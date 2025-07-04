    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Payment Successful</title>
    </head>
    <body>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <div class="d-flex justify-content-center align-items-center" style="min-height:80vh;">
    <div class="card p-4 text-center shadow" style="max-width: 500px;">
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#dc3545" class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M15.854 7.146a.5.5 0 0 1 0 .708l-8 8a.5.5 0 0 1-.708 0l-4-4a.5.5 0 1 1 .708-.708L7.5 14.293l7.646-7.647a.5.5 0 0 1 .708 0z"/>
                <path d="M1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8z"/>
            </svg>
        </div>
        <h2>Payment Cancelled</h2>
        <p>You cancelled the transaction.</p>
        <a href="{{ route('payment-requests') }}" class="btn btn-outline-secondary mt-3">Back to Payments</a>
    </div>
</div>
    </body>
    </html>

    </div>

