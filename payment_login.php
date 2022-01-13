<?php $title="Payment"; include("template/base_header.php"); ?>
    <div class="contianer">
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Payment</span>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="John Doe" name="name" id="name" type="text" class="validate">
                                <label for="name">Name on Card</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="1234 5678 4208 0012" name="ccNumber" id="ccNumber" type="text" class="validate">
                                <label for="name">Card Number</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="123" name="cvv" id="cvv" type="text" class="validate">
                                <label for="name">CVV</label>
                            </div>
                            <div class="input-field col s6">
                                <input placeholder="01/21" name="expiration" id="expiration" type="text" class="validate">
                                <label for="name">Expiration Date</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s6 offset-s3 m4 offset-m4">
                                <a href="post_payment.html" class="waves effect waves-light btn-large center-align">
                                    <i class="material-icons left">credit_card</i>SUBMIT
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("template/base_footer.php"); ?>