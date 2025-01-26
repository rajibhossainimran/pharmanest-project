<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row g-4">
            <!-- Return From Customer -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Return From Customer</h5>
                        <form>
                            <div class="mb-3">
                                <label for="invoiceNo" class="form-label">Invoice No <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="invoiceNo" placeholder="Invoice No" required>
                            </div>
                            <button type="submit" class="btn btn-success">Search</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Return To Manufacturer -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Return To Manufacturer</h5>
                        <form>
                            <div class="mb-3">
                                <label for="purchaseId" class="form-label">Purchase Id <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="purchaseId" placeholder="Purchase Id" required>
                            </div>
                            <button type="submit" class="btn btn-success">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
