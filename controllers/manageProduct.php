<?php

class manageProduct
{
    public function product_add()
    {

    }

    public function product_update()
    {
        include '../../conn.php';

        $prodID = $_REQUEST['productID'];
        $_SESSION['prodID'] = $prodID;
        $prodCat = $_REQUEST['prodCat'];
        $prodDesc = $_REQUEST['prodDesc'];
        $prodPrice = $_REQUEST['prodPrice'];
        $prodDisc = $_REQUEST['prodDisc'];
        $prodInv = $_REQUEST['prodInv'];
        $currentPicture = $_REQUEST['currentPicture'];
        $prodPic = $_REQUEST['prodPic'];
        $instock = $_REQUEST['instock'];

        // $sql = "INSERT INTO user VALUES ('','$uFullname','$uName','$uPass','$uEmail','$uPhone', '$uLocation', '' )";
        $updateQuery = "UPDATE `product` SET
        `categoryID`='$prodCat',
        `prodName`='$prodName',
        `prodDesc`='$prodDesc',
        `inventoryNo`='$prodInv',
        `prodPrice`='$prodPrice',
        `inStock`='$instock',
        `discAmount`='$prodDisc',
        `prodPicture`='$prodPic'
        WHERE id='$prodID'";

        $updateQuery2 = "UPDATE `product` SET
        `categoryID`='$prodCat',
        `prodName`='$prodName',
        `prodDesc`='$prodDesc',
        `inventoryNo`='$prodInv',
        `inStock`='$instock',
        WHERE id='$prodID'";

        // INSERT PICTURE THINGY 

        if ($prodPrice < 0 || $prodDisc < 0 || $prodDisc > 100) {
            mysqli_query($conn, $updateQuery2);
            $_SESSION['updateProduct'] = "<div>Price Cannot Be Below 0!!! </div><div>Discount is between 0-100 only!!!</div>";
            echo '<script>window.location.href = "../../views/vendor/vendorHomepage.php"</script>';

        } else if (mysqli_query($conn, $updateQuery)) {
            //$_SESSION['loginVendor'] = "<div >Update Succesful.</div>";
            echo '
			<script>
			sweetAlert({
					title: "Product Updated!",
					text: "Data Stored Successfully",
					type: "success",
				},

				function(){
							window.location.href ="../../views/vendor/vendorHomepage.php";
				});

				</script>
				';
        } else {
            echo '
				<script>
				swal({
				title: "ERROR: 404!",
				text: "Please Contact Admin",
				type: "warning",
			},
				function(){
					window.location.href ="../../views/vendor/vendorHomepage.php";
				});


				</script>
				 ';
            mysqli_error($conn);
        }
        mysqli_close($conn);
    }

    public function product_delete()
    {

    }
}
