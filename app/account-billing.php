<?php
    
    require ('../system/DatabaseConnector.php');
    if (!user_is_logged_in()) {
        user_login_redirect();
    }
    $title = 'Account Billing - Lavina - Namibra';
    $body_class = "bg-secondary";
    $playSound = false;
    require ('../system/inc/head.php');
    require ('inc/header.php');
    require ('inc/left.nav.php');

    //
    $post = cleanPost($_POST);
    $mm_type = ((isset($_POST['mm_type']) && !empty(['mm_type'])) ? $post['mm_type']: '');
    $mm_name = ((isset($_POST['mm_name']) && !empty(['mm_name'])) ? $post['mm_name']: '');
    $mm_number = ((isset($_POST['mm_number']) && !empty(['mm_number'])) ? $post['mm_number']: '');
    $cc_name = ((isset($_POST['cc_name']) && !empty(['cc_name'])) ? $post['cc_name']: '');
    $cc_number = ((isset($_POST['cc_number']) && !empty(['cc_number'])) ? $post['cc_number']: ''); 
    $cc_expiration = ((isset($_POST['cc_expiration']) && !empty(['cc_expiration'])) ? $post['cc_expiration']: ''); 
    $cc_cvv = ((isset($_POST['cc_cvv']) && !empty(['cc_cvv'])) ? $post['cc_cvv']: '');
    $pp_name = ((isset($_POST['pp_name']) && !empty(['pp_name'])) ? $post['pp_name']: ''); 
    $pp_email = ((isset($_POST['pp_email']) && !empty(['pp_email'])) ? $post['pp_email']: '');
    if (isset($_POST['method']) && !empty($_POST['method'])) {
        $method = $post['method'];

        dnd($_POST);

        if ($method == 'mm') {
            mm_type
            mm_name
            mm_number
        } else if ($method == 'pp') { 
        
        } else if ($method == 'cc') { 
        
        }
    }
    

?>

            <!-- Add payment card modal -->
            <div class="modal fade" id="addCard" data-bs-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h4 class="modal-title">Add new payment method</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body pt-0" id="methodForm" method="POST">
                            <div class="mb-4">
                                <label class="form-label" for="card-name">Select payment method</label>
                                <select class="form-select" type="text" required id="method" name="method">
                                    <option value="" selected></option>
                                    <option value="mm">Money Mobile</option>
                                    <option value="pp">Paypal</option>
                                    <option value="cc">Credit Card</option>
                                </select>
                            </div>

                            <!-- MoMo -->
                            <div id="momo" class="d-none">
                                <div class="mb-4">
                                    <label class="form-label" for="card-name">Mobile Money type</label>
                                    <select class="form-select" type="text" required id="mm_type" name="mm_type">
                                        <option value="" selected></option>
                                        <option value="mtn" <?= (($mm_type == 'mtn') ? 'selected' : ''); ?>>MTN Money Mobile</option>
                                        <option value="airteltigo" <?= (($mm_type == 'airteltigo') ? 'selected' : ''); ?>>AirtelTigo Money</option>
                                        <option value="telecel" <?= (($mm_type == 'telecel') ? 'selected' : ''); ?>>Telecel Cash</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="card-name">Name on number</label>
                                    <input class="form-control" type="text" placeholder="Hamza Zero" required id="mm_name" name="mm_name" value="<?= $mm_name; ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="card-number">Momo number</label>
                                    <div class="input-group">
                                        <input class="form-control" type="tel" data-format='{"numericOnly": true, "delimiters": ["+233 ", " ", " "], "blocks": [0, 3, 3, 2]}' placeholder="+233 ___ ___ __" required id="mm_number" name="mm_number" value="<?= $mm_number; ?>">
                                        <div class="input-group-text py-0">
                                            <div class="credit-card-icon"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Credit Card -->
                            <div id="crca" class="d-none">
                                <div class="mb-4">
                                    <label class="form-label" for="card-name">Name on card</label>
                                    <input class="form-control" type="text" placeholder="Hamza Zero" required id="cc_name" name="cc_name" value="<?= $cc_name; ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="card-number">Card number</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" data-format='{"creditCard": true}' placeholder="XXXX XXXX XXXX XXXX" required id="cc_number" name="cc_number" value="<?= $cc_number; ?>">
                                        <div class="input-group-text py-0">
                                            <div class="credit-card-icon"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cols-2 g-4 pb-2 pb-sm-3 mb-4">
                                    <div class="col">
                                        <label class="form-label" for="card-expiration">Expiration date</label>
                                        <input class="form-control" type="text" data-format='{"date": true, "datePattern": ["m", "y"]}' placeholder="MM/YY" required id="cc_expiration" name="cc_expiration">
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="card-cvv">CVV Code</label>
                                        <input class="form-control" type="text" data-format='{"numericOnly": true, "blocks": [3]}' placeholder="XXX" required id="cc_cvv" name="cc_cvv">
                                    </div>
                                </div>
                            </div>

                            <!-- Paypal -->
                            <div id="papa" class="d-none">
                                <div class="mb-4">
                                    <label class="form-label" for="card-name">Name</label>
                                    <input class="form-control" type="text" name="pp_name" placeholder="Hamza Zero" required id="pp_name" value="<?= $pp_name; ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="card-number">Email</label>
                                    <div class="input-group">
                                        <input class="form-control" type="email" placeholder="name@email.com" required id="pp_email" name="pp_email" value="<?= $pp_email; ?>">
                                        <div class="input-group-text py-0">
                                            <div class="credit-card-icon"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex flex-column flex-sm-row">
                                <button class="btn btn-secondary mb-3 mb-sm-0" type="reset" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary ms-sm-3" type="button" disabled id="save">Save new card</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                
            <!-- Add new address modal -->
            <div class="modal fade" id="addAddress" data-bs-backdrop="static" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h4 class="modal-title">Add new address</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="modal-body needs-validation pt-0" novalidate>
                            <div class="alert alert-warning d-flex mb-4">
                                <i class="ai-triangle-alert fs-xl me-2"></i>
                                <p class="mb-0">Updating your address may affect your <a href="#" class="alert-link">Tax Location</a></p>
                            </div>
                            <div class="row row-cols-1 row-cols-lg-2 g-4 pb-2 pb-sm-3 mb-4">
                                <div class="col">
                                    <label class="form-label" for="country">Country</label>
                                    <select class="form-select" required id="country">
                                        <option value="" disabled selected>Select a country</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="city">City</label>
                                    <select class="form-select" required id="city">
                                        <option value="" disabled selected>Select a city</option>
                                        <option value="Sydney">Sydney</option>
                                        <option value="Brussels">Brussels</option>
                                        <option value="Toronto">Toronto</option>
                                        <option value="Copenhagen">Copenhagen</option>
                                        <option value="New York">New York</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="state">State</label>
                                    <select class="form-select" required id="state">
                                        <option value="" disabled selected>Select a state</option>
                                        <option value="Arizona">Arizona</option>
                                        <option value="California">California</option>
                                        <option value="Florida">Florida</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Texas">Texas</option>
                                        <option value="Virginia">Virginia</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="address1">Address line 1</label>
                                    <input class="form-control" type="text" required id="address1">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="address2">Address line 2</label>
                                    <input class="form-control" type="text" id="address2">
                                </div>
                                <div class="col">
                                    <label class="form-label" for="postcode">Post code</label>
                                    <input class="form-control" type="text" data-format="{&quot;delimiter&quot;: &quot;-&quot;, &quot;blocks&quot;: [3, 4], &quot;uppercase&quot;: true}" placeholder="XXX-XXXX" id="postcode">
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="set-primary">
                                    <label class="form-check-label text-dark fw-medium" for="set-primary">Set as primary billing address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row">
                                <button class="btn btn-secondary mb-3 mb-sm-0" type="reset" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary ms-sm-3" type="submit">Save address</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--  -->

            <!-- Page content -->
            <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                <h1 class="h2 mb-4">Billing</h1>

                <!-- Payment methods -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-card text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Payment methods</h2>
                        </div>
                        <div class="alert alert-danger d-flex mb-4">
                            <i class="ai-octagon-alert fs-xl me-2"></i>
                            <p class="mb-0">Your primary credit card expired on 01/04/2023. Please add a new card or update this one.</p>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 g-4">

                            <!-- Payment method (primary) -->
                            <div class="col">
                                <div class="card h-100 rounded-3 p-3 p-sm-4">
                                    <div class="d-flex align-items-center pb-2 mb-1">
                                        <h3 class="h6 text-nowrap text-truncate mb-0">Isabella Bocouse</h3>
                                        <span class="badge bg-primary bg-opacity-10 text-primary fs-xs ms-3">Primary</span>
                                        <div class="d-flex ms-auto">
                                            <button class="nav-link fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Edit" aria-label="Edit">
                                                <i class="ai-edit-alt"></i>
                                            </button>
                                            <button class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Delete" aria-label="Delete">
                                                <i class="ai-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <svg width="52" height="42" viewBox="0 0 52 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22.6402 28.2865H18.5199L21.095 12.7244H25.2157L22.6402 28.2865ZM15.0536 12.7244L11.1255 23.4281L10.6607 21.1232L10.6611 21.124L9.27467 14.1256C9.27467 14.1256 9.10703 12.7244 7.32014 12.7244H0.8262L0.75 12.9879C0.75 12.9879 2.73586 13.3942 5.05996 14.7666L8.63967 28.2869H12.9327L19.488 12.7244H15.0536ZM47.4619 28.2865H51.2453L47.9466 12.7239H44.6345C43.105 12.7239 42.7324 13.8837 42.7324 13.8837L36.5873 28.2865H40.8825L41.7414 25.9749H46.9793L47.4619 28.2865ZM42.928 22.7817L45.093 16.9579L46.3109 22.7817H42.928ZM36.9095 16.4667L37.4975 13.1248C37.4975 13.1248 35.6831 12.4463 33.7916 12.4463C31.7469 12.4463 26.8913 13.3251 26.8913 17.5982C26.8913 21.6186 32.5902 21.6685 32.5902 23.7803C32.5902 25.8921 27.4785 25.5137 25.7915 24.182L25.1789 27.6763C25.1789 27.6763 27.0187 28.555 29.8296 28.555C32.6414 28.555 36.8832 27.1234 36.8832 23.2271C36.8832 19.1808 31.1331 18.8041 31.1331 17.0449C31.1335 15.2853 35.1463 15.5113 36.9095 16.4667Z" fill="#2566AF"/>
                                        <path d="M10.6611 22.1235L9.2747 15.1251C9.2747 15.1251 9.10705 13.7239 7.32016 13.7239H0.8262L0.75 13.9874C0.75 13.9874 3.87125 14.6235 6.86507 17.0066C9.72766 19.2845 10.6611 22.1235 10.6611 22.1235Z" fill="#E6A540"/>
                                        </svg>
                                        <div class="ps-3 fs-sm">
                                            <div class="text-dark">Visa •••• 9016</div>
                                            <div class="text-body-secondary">Debit - Expires 03/24</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment method -->
                            <div class="col">
                                <div class="card h-100 rounded-3 p-3 p-sm-4">
                                    <div class="d-flex align-items-center pb-2 mb-1">
                                        <h3 class="h6 text-nowrap text-truncate mb-0">Isabella Bocouse</h3>
                                        <div class="d-flex ms-auto">
                                            <button class="nav-link fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Edit" aria-label="Edit">
                                                <i class="ai-edit-alt"></i>
                                            </button>
                                            <button class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Delete" aria-label="Delete">
                                                <i class="ai-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <svg width="52" height="42" viewBox="0 0 52 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M31.4109 30.6159H20.5938V10.7068H31.4111L31.4109 30.6159Z" fill="#FF5F00"/>
                                            <path d="M21.28 20.6617C21.28 16.6232 23.1264 13.0256 26.0016 10.7072C23.8252 8.94968 21.1334 7.99582 18.3618 8.00001C11.5344 8.00001 6 13.6688 6 20.6617C6 27.6547 11.5344 33.3235 18.3618 33.3235C21.1334 33.3277 23.8254 32.3738 26.0018 30.6163C23.1268 28.2983 21.28 24.7005 21.28 20.6617Z" fill="#EB001B"/>
                                            <path d="M46.0028 20.6617C46.0028 27.6547 40.4684 33.3235 33.641 33.3235C30.8691 33.3276 28.1768 32.3738 26 30.6163C28.876 28.2979 30.7224 24.7005 30.7224 20.6617C30.7224 16.623 28.876 13.0256 26 10.7072C28.1768 8.94974 30.8689 7.99589 33.6408 8.00001C40.4682 8.00001 46.0026 13.6688 46.0026 20.6617" fill="#F79E1B"/>
                                        </svg>
                                        <div class="ps-3 fs-sm">
                                            <div class="text-dark">MasterCard •••• 4242</div>
                                            <div class="text-body-secondary">Checking - Expires 01/25</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment method -->
                            <div class="col">
                                <div class="card h-100 rounded-3 p-3 p-sm-4">
                                    <div class="d-flex align-items-center pb-2 mb-1">
                                        <h3 class="h6 text-nowrap text-truncate mb-0">Isabella Bocouse</h3>
                                        <div class="d-flex ms-auto">
                                            <button class="nav-link fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Edit" aria-label="Edit">
                                                <i class="ai-edit-alt"></i>
                                            </button>
                                            <button class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Delete" aria-label="Delete">
                                                <i class="ai-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <svg width="52" height="42" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 42"><path fill="#03a9f4" d="M37.3,11.8c-0.2-0.1-0.5-0.1-0.7,0c-0.2,0.1-0.4,0.3-0.4,0.6c0,0.2-0.1,0.5-0.1,0.7c-1.4,6.3-4.2,9.4-8.5,9.4h-6.4c-0.3,0-0.6,0.2-0.7,0.6l-2.1,10L18,35.5c-0.2,1.2,0.5,2.3,1.7,2.5c0.1,0,0.3,0,0.4,0h4.3c1,0,1.8-0.7,2.1-1.6l1.7-6.9h3.7c4.4,0,7.4-3.5,8.5-9.8l0,0C41.1,16.7,39.9,13.5,37.3,11.8z"/><path fill="#283593" d="M36,6.5c-1.4-1.6-3.4-2.5-5.5-2.5H18.6c-1.8,0-3.3,1.3-3.5,3l-3.7,24.4c-0.2,1.2,0.6,2.3,1.8,2.4c0.1,0,0.2,0,0.3,0H19c0.3,0,0.6-0.2,0.7-0.6l2-9.4h5.8c5.1,0,8.4-3.5,9.9-10.5c0.1-0.3,0.1-0.6,0.1-0.8C38,10.3,37.4,8.1,36,6.5z"/></svg>
                                        <div class="ps-2 fs-sm">
                                            <div class="text-dark">Electronic payment system</div>
                                            <div class="text-body-secondary">bocouse@example.com</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add payment method -->
                            <div class="col">
                                <div class="card h-100 justify-content-center align-items-center border-dashed rounded-3 py-5 px-3 px-sm-4">
                                    <a class="stretched-link d-flex align-items-center fw-semibold text-decoration-none" href="#addCard" data-bs-toggle="modal">
                                        <i class="ai-circle-plus fs-xl me-2"></i>
                                        Add new payment methods
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Billing address -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center pb-4 mt-sm-n1 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-map-pin text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Billing address</h2>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 g-4">

                            <!-- Address (primary) -->
                            <div class="col">
                                <div class="card h-100 rounded-3 p-3 p-sm-4">
                                    <div class="d-flex align-items-center pb-2 mb-1">
                                        <h3 class="h6 text-nowrap text-truncate mb-0">Billing address #1</h3>
                                        <span class="badge bg-primary bg-opacity-10 text-primary fs-xs ms-3">Primary</span>
                                        <div class="d-flex ms-auto">
                                            <button class="nav-link fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Edit" aria-label="Edit">
                                                <i class="ai-edit-alt"></i>
                                            </button>
                                            <button class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Delete" aria-label="Trash">
                                                <i class="ai-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="mb-0">314 Robinson Lane,<br>Wilmington, DE 19805,<br>USA</p>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col">
                                <div class="card h-100 rounded-3 p-3 p-sm-4">
                                    <div class="d-flex align-items-center pb-2 mb-1">
                                        <h3 class="h6 text-nowrap text-truncate mb-0">Billing address #2</h3>
                                        <div class="d-flex ms-auto">
                                            <button class="nav-link fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Edit" aria-label="Edit">
                                                <i class="ai-edit-alt"></i>
                                            </button>
                                            <button class="nav-link text-danger fs-xl fw-normal py-1 pe-0 ps-1 ms-2" type="button" data-bs-toggle="tooltip" title="Delete" aria-label="Delete">
                                                <i class="ai-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="mb-0">401 Magnetic Drive Unit 2,<br>Toronto, Ontario, M3J 3H9<br>Canada</p>
                                </div>
                            </div>

                            <!-- Add address -->
                            <div class="col">
                                <div class="card h-100 justify-content-center align-items-center border-dashed rounded-3 py-5 px-3 px-sm-4">
                                    <a class="stretched-link d-flex align-items-center fw-semibold text-decoration-none my-sm-3" href="#addAddress" data-bs-toggle="modal">
                                        <i class="ai-circle-plus fs-xl me-2"></i>
                                        Add new address
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mt-sm-2 mt-md-3">
                            <h3 class="h6 mb-1">Tax location</h3>
                            <p class="mb-0">Republic of Ghana - 0.8% VAT</p>
                        </div>
                        <div class="alert alert-info d-flex mb-0">
                            <i class="ai-circle-info fs-xl me-2"></i>
                            <p class="mb-0">Your text location determines the taxes that are applied to your bill. <a href="#" class="alert-link">Learn more</a></p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Divider for dark mode only -->
    <hr class="d-none d-dark-mode-block">

    <!-- Sidebar toggle button -->
    <button class="d-lg-none btn btn-sm fs-sm btn-primary w-100 rounded-0 fixed-bottom" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarAccount">
        <i class="ai-menu me-2"></i>
        Account menu
    </button>

<?php require('../system/inc/footer.php'); ?>
<script>
//
var selectedValue = ''
$('#method').on('change', function() {
    selectedValue = $(this).val()
    if (selectedValue) {
        if (selectedValue == 'mm') {
            $('#momo').removeClass('d-none')
            
            $('#crca').addClass('d-none')
            $('#papa').addClass('d-none')
        } else if (selectedValue == 'pp') {
            $('#papa').removeClass('d-none')
            
            $('#crca').addClass('d-none')
            $('#momo').addClass('d-none')
        } else if (selectedValue == 'cc') {
            $('#crca').removeClass('d-none')
            
            $('#momo').addClass('d-none')
            $('#papa').addClass('d-none')
        }
        
        $('#save').attr('disabled', false)
    } else {
        $('#momo').addClass('d-none')
        $('#crca').addClass('d-none')
        $('#papa').addClass('d-none')
        $('#save').attr('disabled', true)
        
        alert('No option selected')
    }
})

//
$('#save').on('click', function() {
    if (selectedValue == 'mm') {
        if ($('#mm_type').val() == '') {
            $('#mm_type').focus()
            alert('Mobile money type is required 🤦‍♂️!');
            return false
        }

        if ($('#mm_name').val() == '') {
            $('#mm_name').focus()
            alert('Mobile money name is required 🤦‍♂️!');
            return false
        }

        if ($('#mm_number').val() == '') {
            $('#mm_number').focus()
            alert('Mobile money number is required 🤦‍♂️!');
            return false
        }
    
    } else if (selectedValue == 'pp') {
        if ($('#pp_name').val() == '') {
            $('#pp_name').focus()
            alert('Paypal name is required 🤦‍♂️!');
            return false
        }

        if ($('#pp_email').val() == '') {
            $('#pp_email').focus()
            alert('Paypal email is required 🤦‍♂️!');
            return false
        }
    } else if (selectedValue == 'cc') {

        if ($('#cc_name').val() == '') {
            $('#cc_name').focus()
            alert('Credit card name is required 🤦‍♂️!');
            return false
        }

        if ($('#cc_number').val() == '') {
            $('#cc_number').focus()
            alert('Credit card number is required 🤦‍♂️!');
            return false
        }

        if ($('#cc_expiration').val() == '') {
            $('#cc_expiration').focus()
            alert('Credit card expiration date is required 🤦‍♂️!');
            return false
        }

        if ($('#cc_cvv').val() == '') {
            $('#cc_cvv').focus()
            alert('Credit card CVV is required 🤦‍♂️!');
            return false
        }
    }

    $('#methodForm').submit()
})
</script>