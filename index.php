<!doctype html>
<html lang="en">
<!-- load HTML headers -->
    <?php require_once('headers.php');?>

    <body>
        <?php
            $nonApiData = [
                'account_id' => '100111',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email_address' => 'test@test.com',
                'residence_country' => 'Philippines',
                'citizenship_country' => 'Philippines',
                'residence_country_postal' => 'na',
                'mobile_number' => '001-123456789',
                'amount' => '5.00',
                'currency' => 'USD',
                'funding_source_id' => '6789',
                'transaction_id' => 'abc123456',
                'organization_id' => '12'
            ];

            $customApiData = [
                'id' => 'id12345',
                'amount' => '12345.00',
                'reference_id' => 'abc123456',
                'currency' => 'USD',
                'return_url' => 'https://dev1.currentdesk.com/FundTransfer/Confirmation',
                'notification_url' => 'https://uat.currentcashier.com/v1/callback/12345',
                // 'orientation' => 'deposit', //deposits as default, as withdrawals are not yet integrated with custom API
                'email_address' => 'test@test.com',
                'last_name' => 'Doe',
                'account_id' => '100111',
                'first_name' => 'John',
                'postal_code' => '',
                'mobile_number' => '001-123456789',
                'funding_source_id' => '6789',
                'country_of_residence' => 'PH',
                'country_of_citizenship' => 'PH'
            ];

            $paymentTypes = ['Perfect Money', 'Fasapay'];

            $paymentOrientations = ['deposit', 'withdraw'];
        ?>
        <div class="container m-10">
            <div class="row justify-content-around p-5">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            Non-API
                        </div>
                        <div class="card-body p-5">
                            <form id="nonapi-payment-details" class="payment-form pb-5">
                                <div class="form-group mb-4">
                                    <label for="type">Payment Type</label>
                                    <select type="text" class="form-select" id="type" name="type">
                                        <?php foreach($paymentTypes as $paymentType){
                                            echo '<option value="' . strtolower(str_replace(' ', '-', $paymentType)) . '">' . $paymentType . '</option>';
                                        }?>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="orientation">Payment orientation</label>
                                    <select type="text" class="form-select" id="orientation" name="orientation">
                                        <?php foreach($paymentOrientations as $paymentOrientation){
                                            echo '<option value="' . $paymentOrientation . '">' . $paymentOrientation . '</option>';
                                        }?>
                                    </select>
                                </div>

                                <?php 
                                    $template = '';
                                    foreach($nonApiData as $key => $value){
                                        $template .= '
                                            <div class="form-group mb-4">
                                                <label for="' . $key . '" class="mb-1">' . ucfirst(str_replace('_', ' ', $key)) . '</label>
                                                <input type="text" class="form-control" id="' . $key . '" name="'. $key . '" value="' . $value . '">
                                            </div>
                                        ';
                                    }

                                    echo $template;
                                ?>
                            </form>

                            <h5>URL:</h5>
                            <a id="nonAPILink" target="_blank" href=""><p id="nonAPIOutput" class="text-center"></p></a>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                            <div class="card-header">
                                Custom API
                            </div>
                            <div class="card-body p-5">
                                <form id="customapi-payment-details" class="payment-form pb-5" action="#" method="POST">
                                    <div class="form-group mb-4">
                                        <label for="type">Payment Type</label>
                                        <select type="text" class="form-select" id="type" name="type">
                                            <?php foreach($paymentTypes as $paymentType){
                                                echo '<option value="' . strtolower(str_replace(' ', '-', $paymentType)) . '">' . $paymentType . '</option>';
                                            }?>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4">
                                    <label for="orientation">Payment orientation</label>
                                    <select type="text" class="form-select" id="orientation" name="orientation">
                                        <?php foreach($paymentOrientations as $paymentOrientation){
                                            echo '<option value="' . $paymentOrientation . '">' . $paymentOrientation . '</option>';
                                        }?>
                                    </select>
                                </div>

                                    <?php 
                                        $template = '';
                                        foreach($customApiData as $key => $value){
                                            $template .= '
                                                <div class="form-group mb-4">
                                                    <label for="' . $key . '" class="mb-1">' . ucfirst(str_replace('_', ' ', $key)) . '</label>
                                                    <input type="text" class="form-control" id="' . $key . '" name="'. $key . '" value="' . $value . '">
                                                </div>
                                            ';
                                        }
                                        echo $template;
                                    ?>

                                    <div class="form-group mb-4">
                                        <input type="submit" class="btn btn-primary form-control" id="customapi-submit-btn">
                                    </div>
                                </form>

                                <h5>URL:</h5>
                                <p id="customApiOutput" class="text-center"></p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>