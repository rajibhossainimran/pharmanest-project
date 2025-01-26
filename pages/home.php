<main class="app-main">
<div class="grey-bg container-fluid">
  <section id="minimal-statistics">
    <div class="row">
      <div class="col-12 mt-3 mb-1">
        <h4 class="text-uppercase">Dashboard</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-3 col-sm-6 col-12 mb-4"> 
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex justify-content-around">
                <div class="align-self-center">
                <i class="bi bi-cash-coin text-info-emphasis fs-1"></i><br>
                <a class="text-danger-emphasis" href="sell_list.php">show details</a>
                </div>
                <div class="media-body text-right">
                <?php
                            $amount =0;
                            $selllist = $db->query("SELECT * FROM total_sell");
                            while (list($_id, $singleSell,$date) = $selllist->fetch_row()) {
                               $amount = $amount + (int)$singleSell;
                               
                            }
                        ?>
                  <h5 class="fw-semibold">Total Sell</h5>
                  <h6 class="text-info-emphasis fw-bold"><?php echo$amount;?> <span> taka</span></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
      <div class="card">
      <i class=""></i>
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex justify-content-around">
                <div class="align-self-center">
                <i class="bi bi-cash-coin text-info-emphasis fs-1"></i><br>
                <a class="text-danger-emphasis" href="purchase_list.php">show details</a>
                </div>
                <div class="media-body text-right">
                <?php
                            $amount2 =0;
                            $purchaselist = $db->query("SELECT * FROM total_purchase");
                            while (list($_id, $singleSell,$date) =  $purchaselist->fetch_row()) {
                               $amount2 = $amount2 + (int)$singleSell;
                               
                            }
                        ?>
                  <h5 class="fw-semibold">Total Purchase</h5>
                  <h6 class="text-info-emphasis fw-bold"><?php echo$amount2;?> <span> taka</span></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 col-12">
      <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex justify-content-around">
                <div class="align-self-center">
                <i class="bi bi-calendar3 text-info-emphasis fs-1"></i><br>
                <a class="text-danger-emphasis" href="today_sell_list.php">show details</a>
                </div>
                <div class="media-body text-right">
                  <?php 
                  // Get today's date
                  $today = date('Y-m-d');

                  $todayAmount = 0;
                  $selllist = $db->query("SELECT * FROM total_sell WHERE date = '$today'");

                  while (list($_id, $singleSell, $date) = $selllist->fetch_row()) {
                      $todayAmount += (int)$singleSell; 
                  }
                  ?>
                  <h5 class="fw-semibold">Today Sell</h5>
                  <h6 class="text-info-emphasis fw-bold">
                      <?php echo $todayAmount; ?> <span>taka</span>
                  </h6>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </section>

  <section>
  <div class="row mt-5 mb-5">

    <div class="col-xl-4 col-sm-6 col-12 mb-4"> 
      <div style=" border-radius:15px; border: 3px solid #0b5345; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;" class="d-flex justify-content-around align-items-center py-4">
        <div>
          <i 
          style="font-size: 60px; border-radius: 50%; border: 2px solid #0b5345; box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;" 
          class="bi bi-capsule-pill text-info-emphasis d-block px-3 py-2 bg-light">
        </i>

        </div>
        <div class="d-flex flex-column align-items-center justify-content-center">
          <?php 
          // Query to count the total number of medicines
          $result = $db->query("SELECT COUNT(*) AS total FROM medicines");

          if ($result) {
              $row = $result->fetch_assoc();
              $totalMedicines = $row['total'];
          } else {
              $totalMedicines = 0;
          }
          ?>
          <h4 class="fw-semibold">Total Medicine</h4>
          <h2 class="text-center"><?php echo $totalMedicines; ?></h2>
          <a class="text-primary" href="medicine_list.php">Show Details</a>
      </div>

      </div>

      </div>

      <div class="col-xl-4 col-sm-6 col-12 mb-4">
    
      <div style=" border-radius:15px; border: 3px solid #0b5345; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;" class="d-flex justify-content-around align-items-center py-4 ">
        <div>
          <i 
          style="font-size: 60px; border-radius: 50%; border: 2px solid #0b5345; box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;" 
          class="bi bi-cart-x text-warning-emphasis  d-block px-3 py-2 bg-light">
        </i>

        </div>
        <div class="d-flex flex-column align-items-center justify-content-center">
            <h4 class="fw-semibold ">Out of Stock</h4>
            <h2 class="text-center ">00</h2>
            <a class="text-primary" href="#">show details</a>
        </div>
      </div>
      </div>

      <div class="col-xl-4 col-sm-6 col-12 mb-4">
      <div style=" border-radius:15px; border: 3px solid #0b5345; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;" class="d-flex justify-content-around align-items-center py-4">
        <div>
          <i 
          style="font-size: 60px; border-radius: 50%; border: 2px solid #0b5345; box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;"  
          class="bi bi-exclamation-triangle text-danger d-block px-3 py-2 bg-light">
        </i>

        </div>
        <div class="d-flex flex-column align-items-center justify-content-center">
            <h4 class="fw-semibold ">Expired Medicine</h4>
            <h2 class="text-center ">00</h2>
            <a class="text-primary" href="#">show details</a>
        </div>
      </div>

      </div>

    </div>
  </section>

  <section>
    <div class="row mx-5">
    <div style="border: 1px solid #0b5345;" class="card">
            <div style="background-color: #0b5345;" class="card-header text-white text-center">
                <h5 class="fw-semibold text-center">Today's Sell Report</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                <?php 
                  // Get today's date
                  $today = date('Y-m-d');
                  // today sell 
                  $todayAmount2 = 0;
                  $selllist = $db->query("SELECT * FROM total_sell WHERE date = '$today'");
                  // today purchase 
                  $todayPurchase = 0;
                  $purchaselist = $db->query("SELECT * FROM total_purchase WHERE date = '$today'");

                  while (list($_id, $singleSell, $date) =  $purchaselist->fetch_row()) {
                    $todayPurchase += (int)$singleSell; 
                  }

                  while (list($_id, $singleSell, $date) =  $selllist->fetch_row()) {
                    $todayAmount2 += (int)$singleSell; 
                  }
                  ?>
                    <thead class="table-success">
                        <tr>
                            <th>Today report</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Today Sell</td>
                            <td><?php echo $todayAmount2;?><span> Taka</span></td>
                        </tr>
                        <tr>
                            <td>Purchase</td>
                            <td><?php echo $todayPurchase;?><span> Taka</span></td>
                        </tr>
                        <tr>
                            <td>Cash Received</td>
                            <td><?php echo $todayAmount2;?><span> Taka</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  </section>
</div>
</main>