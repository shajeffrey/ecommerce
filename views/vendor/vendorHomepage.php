<?php
session_start();
include 'templates/vHomeHeader.php';
include '../../controllers/search.php';
?>
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h1 class="sessionName">Welcome <?=$_SESSION['vendorName'];?></h1>
    </div>
</div>
<?php
if (isset($_SESSION['loginVendor'])) {
    echo $_SESSION['loginVendor'];
    unset($_SESSION['loginVendor']);
}
?>
<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card p-3  py-4">
                    <h5>Find Your Product</h5>
                    <div class="row g-3 mt-2">

                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Search Your Catalogue?">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-secondary btn-block" name="searchbyVendor">Search Results</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php
include 'templates/footer.php';
?>
<?php
if (isset($_REQUEST['searchVendor'])) {
    $search = new search();
    $search->search_vendor($_REQUEST);
}
?>
