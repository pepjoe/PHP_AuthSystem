<?php include_once('lib/header.php');
require_once('functions/redirect.php');
require_once('functions/tokens.php'); 
if(!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== "Player"){
    // redirect to login
    redirect_to('login.php');
}

$email = $_SESSION['email'];
$amount = 2000;
$txref = generate_txref();
echo $txref;


?>

<div class="pricing-header mt-5 px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center border-bottom shadow-sm">
    <h1 class="display-5">
    
    <form>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <button  class="btn btn-bg btn-primary" type="button" onClick="payWithRave()">Proceed to Payment</button>
    </form>
    
    </h1>
</div>

<script>
    const API_publicKey = "FLWPUBK_TEST-4363836c07fc430012c40d46f9f12efb-X";

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: '<?php echo $email; ?>',
            amount: '<?php echo $amount; ?>',
            customer_phone: "",
            currency: "NGN",
            txref: '<?php echo $txref; ?>',
            meta: [{
                metaname: "DevPepjoe",
                metavalue: "AP1234"
            }],
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect txRef returned and pass to a server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                    // redirect to a success page
                    window.location = "payment_successful.php?txref=" + txref;
                } else {
                    // redirect to a failure page
                    window.location = "payment_failed.php"
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>

<?php
include_once('lib/footer.php');
?>