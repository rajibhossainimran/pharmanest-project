<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Bootstrap Modal</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <!-- Button to open the modal -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">
      Open Modal
    </button>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="invoiceModalLabel">Invoice</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalContent">
          <h2>Invoice Details</h2>
          <p>Item: Product A</p>
          <p>Quantity: 2</p>
          <p>Price: $50</p>
          <hr>
          <p>Total: $100</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="printBtn">Print</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('printBtn').addEventListener('click', () => {
      const modalContent = document.getElementById('modalContent').innerHTML; // Get the modal content
      const originalContent = document.body.innerHTML; // Save the original page content

      // Replace the body content with modal content for printing
      document.body.innerHTML = modalContent;
      window.print(); // Trigger print dialog

      // Restore the original content after printing
      document.body.innerHTML = originalContent;
      window.location.reload(); // Reload the page to restore event listeners and Bootstrap functionality
    });
  </script>
</body>
</html>
