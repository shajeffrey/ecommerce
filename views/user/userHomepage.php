<?php
session_start();
include 'templates/uHomeHeader.php';
?>

<!-- margin y axis (top/bottom) -->
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h1 class="sessionName">Welcome <?php // session()->get('fullName')?></h1>
    </div>
</div>
<?php 
if(isset($_SESSION['loginUser']))
{
    echo $_SESSION['loginUser'];
    unset($_SESSION['loginUser']);
}
?>
<div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card p-3  py-4">
                    <h5>An Easier way to find your Housing</h5>
                    <div class="row g-3 mt-2">
                        <div class="col-md-3">
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                Any Status
                            </button>
                            <!--php category here -->
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">Rural</a></li>
                                <li><a class="dropdown-item" href="#">Urban</a></li>
                                <li><a class="dropdown-item" href="#">All</a></li>
                            </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Enter address e.g. street, city and state or zip">
                        </div>

                        <div class="col-md-3">
                            <button class="btn btn-secondary btn-block">Search Results</button>
                        </div>

                    </div>

                    <div class="mt-3">

                        <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="advanced">
                            Advance Search With Filters <i class="fa fa-angle-down"></i>
                        </a>

                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <input type="text" placeholder="Property ID" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Search by MAP">
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Search by Country">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'templates/footer.php';
?>

