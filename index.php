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
                'orientation' => 'deposit', //deposits as default, as withdrawals are not yet integrated with custom API
                'email' => 'test@test.com',
                'last_name' => 'Doe',
                'account_id' => '100111',
                'first_name' => 'John',
                'postal_code' => '',
                'mobile_number' => '001-123456789',
                'funding_source_id' => '6789',
                'country_of_residence' => 'PH',
                'country_of_citizenship' => 'PH'
            ];

            $paymentTypes = ['Fasapay', 'Perfect Money'];

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
                            <form id="payment-details" class="pb-5">
                                <div class="form-group mb-4">
                                    <label for="type">Payment Type</label>
                                    <select type="text" class="form-select" id="type" name="type">
                                        <?php foreach($paymentTypes as $paymentType){
                                            echo '<option value="' . strtolower(str_replace(' ', '-', $paymentType)) . '">' . $paymentType . '</option>';
                                        }?>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="type">Payment orientation</label>
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

                                <div class="form-group mb-4">
                                    <label for="funding_source_name" class="mb-1">Funding source name</label>
                                    <input type="text" class="form-control" id="funding_source_name" name="funding_source_name">
                                </div>

                                <div class="form-group mb-4">
                                    <button type="button" class="btn btn-primary form-control" id="submit-btn">Submit</button>
                                </div>
                            </form>

                            <h5>URL:</h5>
                            <h2 id="nonAPIOutput" class="text-center"></h2>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                            <div class="card-header">
                                Custom API
                            </div>
                            <div class="card-body p-5">
                                <form id="payment-details" class="pb-5">
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
                                </form>

                                <h5>URL:</h5>
                                <h1 id="outputText" class="text-center"></h1>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>