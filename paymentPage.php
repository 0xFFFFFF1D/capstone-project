<?php
    session_start();
    $title = "Payment";
    include("template/base_header.php");
?>

<div class="container mainContainer">
    <!--SCRIPT-->
    <script type="text/javascript" src="https://april-institute.myhelcim.com/js/version2.js"></script>
    <script>
        function showCard() {
            document.getElementById("helcimResultsCard").hidden = false;
        }
    </script>

    <div class="row">
        <div class="col s8">
           <div class="card">
               <div class="card-content">
                    <span class="card-title">Payment</span>
                    <form name="helcimForm" id="helcimForm" action="processCreditPurchase.php" method="POST">
                        <input type="hidden" id="token" value="2dac6006aa6f682bbf2b79"> 
                        <input type="hidden" id="language" value="en"> 
                        <input type="hidden" id="test" value="1"> 

                        <input type="hidden" name="amountCredits" value="<?php echo $_REQUEST["amount"]; ?>">
                        <input type="hidden" id="amount" value="<?php echo $_REQUEST["price"]; ?>">

                        <div class="row">
                            <div class="input-field col s10">
                                <input type="text" id="cardNumber" value="">
                                <label for="cardNumber">Credit Card Number</label>
                            </div>
                            <div class="input-field col s2">
                                <input type="text" id="cardCVV" value="">
                                <label for="cardCVV">CVV</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s5">
                                <input type="text" id="cardExpiryMonth" value="">
                                <label for="cardExpiryMonth" value="">Expiry Month</label>
                            </div>
                            <div class="input-field col s7">
                                <input type="text" id="cardExpiryYear" value="">
                                <label for="cardExpiryYear" value="">Expiry Year</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" id="cardHolderName" value="">
                                <label for="cardHolderName">Full Name</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s8">
                                <input type="text" id="cardHolderAddress" value="">
                                <label for="cardHolderAddress">Address</label>
                            </div>
                            <div class="input-field col s4">
                                <input type="text" id="cardHolderPostalCode" value="">
                                <label for="cardHolderPostalCode">Postal Code</label>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col s2 offset-s4">
                                <button class="btn-large waves-effect waves-dark april-orange white-text" type="button" id="buttonProcess" onclick="javascript:helcimProcess(); showCard();">
                                    SUBMIT
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
               </div>
           </div> 
        </div>

        <div class="col s4">
            <div class="row">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Price</span>
                        <h2 style="font-family: monospace;"><?php echo "$" . number_format($_REQUEST["price"]) . ".00" ; ?></h2>
                        <h5 class="grey-text" ><?php echo $_REQUEST["amount"]; ?> credits</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card red" id="helcimResultsCard" hidden>
                   <div class="card-content white-text">
                        <div class="row">
                            <div class="col">
                                <i class="material-icons">error_outline</i>
                            </div>
                            
                            <div class="col" id="helcimResults">
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <!--

    <div class="col s6 offset-s3">
        <div class="row">
            <div class="card red" id="helcimResultsCard" hidden>
                <div class="card-content white-text">
                    <div class="row">
                        <div class="col">
                            <i class="material-icons">error_outline</i>
                        </div>
                        
                        <div class="col" id="helcimResults">
                        </div>
                     </div>
                </div>
            </div>
        </div>

    <form name="helcimForm" id="helcimForm" action="processCreditPurchase.php" method="POST">
        <input type="hidden" id="token" value="2dac6006aa6f682bbf2b79"> 
        <input type="hidden" id="language" value="en"> 
        <input type="hidden" id="test" value="1">

        <input type="hidden" name="amountCredits" value="<?php echo $_REQUEST["amount"]; ?>">

        <div class="row">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Payment</span>
                    <div class="row">
                        <div class="input-field col s8">
                            <input type="text" id="cardNumber" value="">
                            <label for="cardNumber">Credit Card Number</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s2">
                            <input type="text" id="cardExpiryMonth" value="">
                            <label for="cardExpiryMonth" value="">Expiry Month</label>
                        </div>
                        <div class="input-field col s4">
                            <input type="text" id="cardExpiryYear" value="">
                            <label for="cardExpiryYear" value="">Expiry Year</label>
                        </div>
                        <div class="input-field col s2">
                            <input type="text" id="cardCVV" value="">
                            <label for="cardCVV">CVV</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s8 offset-s2">
                            <input type="text" id="cardHolderName" value="">
                            <label for="cardHolderName">Full Name</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6 offset-s2">
                            <input type="text" id="cardHolderAddress" value="">
                            <label for="cardHolderAddress">Address</label>
                        </div>
                        <div class="input-field col s2">
                            <input type="text" id="cardHolderPostalCode" value="">
                            <label for="cardHolderPostalCode">Postal Code</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s8 offset-s2">
                            <input type="text" id="amount" value="<?php echo $_REQUEST["price"]; ?>" disabled><br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s2 offset-s5">
                            <input class="btn-large waves-effect waves-dark white" type="button" id="buttonProcess" value="Process" onclick="javascript:helcimProcess(); showCard();">
                        </div>
                    </div>
                </div>
            </div>
    </div>
        
    </form>
    </div>
    -->
</div>

<?php
    include("template/base_footer.php")
?>