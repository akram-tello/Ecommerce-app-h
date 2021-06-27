<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "../database/db_connection.php";


if(isset($_POST["addToCart"])){
		

    $p_id = $_POST["proId"];
    

    if(isset($_SESSION["uid"])){

    $user_id = $_SESSION["uid"];

    $sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
    $run_query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($run_query);
    if($count > 0){
        echo "
            <div class='alert alert-warning'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Product is already added into the cart Continue Shopping..!</b>
            </div>
        ";
    } else {
        $sql = "INSERT INTO `cart`
        (`p_id`, `ip_add`, `user_id`, `qty`) 
        VALUES ('$p_id','$ip_add','$user_id','1')";
        if(mysqli_query($con,$sql)){
            echo "
                <div class='alert alert-success'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Product is Added..!</b>
                </div>
            ";
        }
    }
    }else{
        $sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
        $query = mysqli_query($con,$sql);
        if (mysqli_num_rows($query) > 0) {
            echo "
                <div class='alert alert-warning'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <b>Product is already added into the cart Continue Shopping..!</b>
                </div>";
                exit();
        }
        $sql = "INSERT INTO `cart`
        (`p_id`, `ip_add`, `user_id`, `qty`) 
        VALUES ('$p_id','$ip_add','-1','1')";
        if (mysqli_query($con,$sql)) {
            echo "
                <div class='alert alert-success'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Your product has been added to cart!</b>
                </div>
            ";
            exit();
        }
        
    }
}

//Count User cart item
if (isset($_POST["count_item"])) {
//When user is logged in then we will count number of item in cart by using user session id
if (isset($_SESSION["uid"])) {
    $sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
}else{
    //When user is not logged in then we will count number of item in cart by using users unique ip address
    $sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
}

$query = mysqli_query($con,$sql);
$row = mysqli_fetch_array($query);
echo $row["count_item"];
exit();
}


//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

if (isset($_SESSION["uid"])) {
    //When user is logged in this query will execute
    $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
}else{
    //When user is not logged in this query will execute
    $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
}
$query = mysqli_query($con,$sql);
if (isset($_POST["getCartItem"])) {
    //display cart item in dropdown menu
    if (mysqli_num_rows($query) > 0) {
        $n=0;
        while ($row=mysqli_fetch_array($query)) {
            $n++;
            $product_id = $row["product_id"];
            $product_title = $row["product_title"];
            $product_price = $row["product_price"];
            $product_image = $row["product_image"];
            $cart_item_id = $row["id"];
            $qty = $row["qty"];
            echo '
                <div class="row">
                    <div class="col-md-3">'.$n.'</div>
                    <div class="col-md-3"><img class="img-responsive" src="assets/img/product_images/'.$product_image.'" /></div>
                    <div class="col-md-3">'.$product_title.'</div>
                    <div class="col-md-3">'.CURRENCY.''.$product_price.'</div>
                </div>';
            
        }
        ?>
            <a style="float:right;" href="cart.php" class="btn btn-warning">Edit&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span></a>
        <?php
        exit();
    }
}


if (isset($_POST["checkOutDetails"])) {
    if (mysqli_num_rows($query) > 0) {
        //display user cart item with "Ready to checkout" button if user is not login
        echo "<form method='post' action='login_form.php'>";
            $n=0;
            while ($row=mysqli_fetch_array($query)) {
                $n++;
                $product_id = $row["product_id"];
                $product_title = $row["product_title"];
                $product_price = $row["product_price"];
                $product_image = $row["product_image"];
                $cart_item_id = $row["id"];
                $qty = $row["qty"];

                echo 
                    '<div class="row">
                            <div class="col-md-2">
                                <div class="btn-group">
                                    <a href="#" remove_id="'.$product_id.'" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>
                                    <a href="#" update_id="'.$product_id.'" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign"></span></a>
                                </div>
                            </div>
                            <input type="hidden" name="product_id[]" value="'.$product_id.'"/>
                            <input type="hidden" name="" value="'.$cart_item_id.'"/>
                            <div class="col-md-2"><img class="img-responsive" src="assets/img/product_images/'.$product_image.'"></div>
                            <div class="col-md-2">'.$product_title.'</div>
                            <div class="col-md-2"><input type="text" class="form-control qty" value="'.$qty.'" ></div>
                            <div class="col-md-2"><input type="text" class="form-control price" value="'.$product_price.'" readonly="readonly"></div>
                            <div class="col-md-2"><input type="text" class="form-control total" value="'.$product_price.'" readonly="readonly"></div>
                        </div>';
            }
            
            echo '<div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <b class="net_total" style="font-size:20px;"> </b>
                </div>';
            if (!isset($_SESSION["uid"])) {
                echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg" value="sgin in first!" >
                        </form>';
                
            }else if(isset($_SESSION["uid"])){
                echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg" value="Pay Now!" >
                </form>';
            }
        }
}


}

?>