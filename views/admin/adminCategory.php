<?php
include 'templates/aHomeHeader.php';
?>
<!-- margin y axis (top/bottom) -->
<div class="my-3">
    <div class="d-flex justify-content-center ">
        <h1 class="sessionName">Admin Categories</h1>
    </div>
</div>

<div class="">
    <div class="container">
        <div class="row">

            <div class="col-12 col-sm-6 bg-light " >
                <div class="m-4">
                    <div class="container sides" >
                        <form action="" method="post" class="">
                            <div class="container">

                                <fieldset>

                                    <div class="row pt-2">
                                        <div class="col-12  col-sm-5">
                                        <legend class="legend1">Add Category</legend>
                                        </div>

                                        <!-- ERROR CHECKING PLACE  -->
                                        <?php if (isset($_SESSION['updateProf'])): ?>
                                        <div class="col-12 col-sm-7">
                                            <div class="alert alert-danger text-center pt-2"  role="alert">
                                                <?php 
                                                echo $_SESSION['updateProf'];
                                                unset($_SESSION['updateProf']);
                                                ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                <hr>
                          
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="labels" for="uFullname">Full Name</label>
                                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                                <input type="text" class=" input form-control" required name="uFullname" id="uFullname" value="<?php echo $_SESSION['userFullname']; ?>">

                                            </div>
                                        </div>

                                        <div class="col-12 ">
                                            <div class="form-group">
                                                <label class="labels" for="uLocation">Location / Address</label>
                                                <!-- setvalue CI4 helper(['form']) in Users Controller -->
                                                <textarea class=" input form-control" required rows="3" name="uLocation" id="uLocation"><?php echo $_SESSION['userLocation']; ?></textarea>
                                            </div>
                                        </div>
                                   

                                </fieldset>
                                
                                <button class="buttonProfile my-4 py-3" name="add" type="submit">Update Profile</button>
                            </div>    
                        </form>

                    </div>

                </div>
            </div>

            <hr>

            <div class="col-12 col-sm-6 bg-light">
                    
                    <div style="background-color: #fff; border-radius:10px;" class="m-5 p-4">

                    <h4 style="color:#be0000;">Manage Product Categories</h4>
                    <br>       
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
            </div>
        
        </div>
    </div>
</div>


<?php
include 'templates/footer.php';
?>
