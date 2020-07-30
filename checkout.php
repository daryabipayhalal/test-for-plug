
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>



<?php
$order_id = $_POST["order_id"];
$amount = $_POST["amount"];

echo $order_id . "|" . $amount;
$host = "http://localhost/daw2/New%20folder/";
$notifyUrl = $host. "/cf-checkout/notify.php";
$returnUrl = $host. "/cf-checkout/return.php";

$orderDetails = array();
$orderDetails["notifyUrl"] = $notifyUrl;
$orderDetails["returnUrl"] = $returnUrl;

$userDetails = getUserDetails($order_id);
$order = getOrderDetails($order_id);

$orderDetails["customer_name"] = $userDetails["customer_name"];
$orderDetails["customer_email"] = $userDetails["customer_email"];
$orderDetails["customer_phone"] = $userDetails["customer_phone"];

$orderDetails["order_id"] = $order["order_id"];
$orderDetails["amount"] = $order["amount"];
$orderDetails["orderNote"] = $order["orderNote"];
$orderDetails["currency"] = $order["currency"];

$orderDetails["appId"] = "app-testing-c721e2bfd0280c7089d5e1f6b934de3a";

$orderDetails["signature"] = generateSignature($orderDetails);

echo json_encode($orderDetails);

function generateSignature($postData){
  $secretKey = "secret-testing-1d79eefc516838395c6422bef453bd5d";
 ksort($postData);
 $signatureData = "";
 foreach ($postData as $key => $value){
      $signatureData .= $key.$value;
 }
 $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
 $signature = base64_encode($signature);
 return $signature;
}
?>
 <form id="redirectForm" method="post" action="https://api.payhalal.my/pay">
  <!-- //    https://api.payhalal.my/pay    -->
  <!-- // if we use this link it will direct to payment page(https://payhalal.me/link/4cfaca16d34a7758e4087c05631b2b31) -->
    <input type="hidden" name="appId" value="<?php echo $orderDetails["appId"] ?>"/>
    <input type="hidden" name="order_id" value="<?php echo $orderDetails["order_id"] ?>"/>
    <input type="hidden" name="amount" value="<?php echo $orderDetails["amount"] ?>"/>
    <input type="hidden" name="currency" value="<?php echo $orderDetails["currency"] ?>"/>
    <input type="hidden" name="orderNote" value="<?php echo $orderDetails["orderNote"] ?>"/>
    <input type="hidden" name="customer_name" value="<?php echo $orderDetails["customer_name"] ?>"/>
    <input type="hidden" name="customer_email" value="<?php echo $orderDetails["customer_email"] ?>"/>
    <input type="hidden" name="customer_phone" value="<?php echo $orderDetails["customer_phone"] ?>"/>
    <input type="hidden" name="returnUrl" value="<?php echo $orderDetails["returnUrl"] ?>"/>
    <input type="hidden" name="notifyUrl" value="<?php echo $orderDetails["notifyUrl"] ?>"/>
    <input type="hidden" name="signature" value="<?php echo $orderDetails["signature"] ?>"/>
  </form>

  <script>document.getElementById("redirectForm").submit();</script>

<?php


function getUserDetails($order_id) {
    return array(
      "customer_name" => "Dawood",
      "customer_email" => "Dawood@PayHalal.com",
      "customer_phone" => "1234567890"
    );
}

function getOrderDetails($order_id) {
  return array(
    "order_id" => time(),
    "amount" => "10",
    "orderNote" => "test order",
    "currency" => "MYR"
  );
}



 ?>


<?php
// Function to compare response hash using sha256
 function ph_sha256_compare( $data, $hash_to_compare, $secret ) {
$hash =
hash('sha256',$secret.$data["amount"].$data["currency"].$data["product_description"].$data["order_id"].
$data["customer_name"].$data["customer_email"].$data["customer_phone"].$data["transaction_id"].$data["status"]);
if ($hash == $hash_to_compare) {
return true;
}
else
{
return false;
}
}
$ph_app_secret = '06583695777e87400b3adcbefe97e49c8369db9d421ceade1fdc35bcbab4432432';
// Now we verify the hash and check if all informations are correct
if (ph_sha256($_POST,$hash_to_compare, $ph_app_secret) == true) {
// The hash could verified, if a callback URL is defined, system must return "OK"
echo "OK";
if ($_POST["status"] == "SUCCESS") {
/*
MARK ORDER AS PAID
*/
}
}
else
{
// The hash could not be verified, in this case you will receive an email with more information
echo "FAILED";
}