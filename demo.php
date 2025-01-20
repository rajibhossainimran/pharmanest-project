 <?php include('check_user.php'); ?>
 <!-- database  -->
 <?php require_once './config/config.php'; ?>
 <!-- header part  -->
 <?php include("./pages/common_pages/header.php"); ?>



 <!--navber and sideber part start-->
 <?php include("./pages/common_pages/navber.php"); ?>
 <?php include("./pages/common_pages/sidebar.php"); ?>

 <!-- main part start  -->
 <main class="app-main">


     <!-- Button to Open the Modal --> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Open Modal </button> <!-- The Modal -->



     <div class="modal fade" id="myModal">
         <div class="modal-dialog">
             <div class="modal-content"> <!-- Modal Header -->
                 <div class="modal-header d-flex justify-content-end">
                     
                     <button type="button" class="btn btn-secondary ms-5" data-dismiss="modal"><i class="bi bi-x-lg"></i></button>

                 </div> <!-- Modal Body -->
                 <div class="d-flex">
                 <h5 class="text-center ms-5">Are you sure you want to delete</h5>
                 </div>
                 <!-- Modal Footer -->
                 <div class="modal-footer">
                     
                     <a href='#' 
                     data-dismiss="modal"
                     class='btn btn-danger btn-sm text-white py-2 px-3 ' data-bs-toggle='tooltip' 
                                  title='Delete'>
                        <i class='bi bi-trash'></i>
                    </a>
                     </div>
             </div>
         </div>
     </div>


     <!-- Bootstrap JS and dependencies -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 </main>
 <!-- main part end -->


 <!-- footer part start  -->
 <?php include("./pages/common_pages/footer.php"); ?>