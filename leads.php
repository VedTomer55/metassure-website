<div class="modal privacy-policy-modal fade" id="leadsModal" aria-labelledby="leadsModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content text-dark">
            <div class="modal-header pop-heading">
                <img src="https://metassure.ai/assets/images/logo/Metassure-Logo-Final-2.png" class="img-fluid" alt="Motor Insurance" style="width:120px">
                <h5 class="modal-title" id="leadsModalModalLabel">Motor Insurance</h5>
            </div>
            <div class="modal-body">
                <form class="card-body cardbody-color p-lg-5" onsubmit="return false;">
                    <div class="mb-3">
                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobileNumber" aria-describedby="mobileNumberHelp" placeholder="Enter Mobile Number" oninput="validateInput('mobileNumber', 'mobileNumberError')">
                        <div id="mobileNumberError" class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="vehicleRC" class="form-label">Vehicle Registration Number</label>
                        <input type="text" class="form-control" id="vehicleRC" placeholder="Enter Vehicle Registration Number" oninput="validateInput('vehicleRC', 'vehicleRCError')">
                        <div id="vehicleRCError" class="error-message"></div>
                    </div>
                    <div style="text-align: end;">
                        <button class="btn-solid" type="button" onclick="submitForm()">
                            <span class="loading-spinner" id="loadingSpinner" style="display: none;"></span>
                            Proceed
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to validate input for numbers only
    function validateInput(inputId, errorId) {
        var inputValue = document.getElementById(inputId).value;
        var errorElement = document.getElementById(errorId);

        // Check if the input contains non-numeric characters
        if (!/^\d*$/.test(inputValue) && inputId != "vehicleRC") {
            errorElement.textContent = 'Only numbers are allowed.';
        } else {
            errorElement.textContent = ''; // Clear the error message
        }
    }

    // Function to validate the mobile number
    function validateMobileNumber() {
        var mobileNumber = document.getElementById('mobileNumber').value;
        var mobileNumberError = document.getElementById('mobileNumberError');
        // Check if the mobile number is 10 digits
        if (/^\d{10}$/.test(mobileNumber)) {
            mobileNumberError.textContent = ''; // Clear the error message
            return true;
        } else {
            mobileNumberError.textContent = 'Please enter a valid 10-digit mobile number.';
            return false;
        }
    }

    // Function to validate the RC number (non-empty validation only)
    function validateRCNumber() {
        var rcNumber = document.getElementById('vehicleRC').value;
        var rcNumberError = document.getElementById('vehicleRCError');
        // Check if the RC number is not empty
        if (rcNumber.trim() !== '') {
            rcNumberError.textContent = ''; // Clear the error message
            return true;
        } else {
            rcNumberError.textContent = 'Please enter the vehicle registration number.';
            return false;
        }
    }

    async function submitForm() {
        if (validateMobileNumber() && validateRCNumber()) {
            // Disable the submit button and show the loading spinner
            document.getElementById('loadingSpinner').style.display = 'inline-block';
            document.querySelector('.btn-solid').disabled = true;

            // Get the values from the form
            var mobileNumber = document.getElementById('mobileNumber').value;
            var rcNumber = document.getElementById('vehicleRC').value;

            // Prepare the data object
            var data = {
                mobile: mobileNumber,
                rc_number: rcNumber
            };

            try {
                // Convert the data to JSON
                var jsonData = JSON.stringify(data);

                // Make the API call using fetch
                var response = await fetch('https://backend-insurance.metawing.ai/v1/bot/user/conversation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: jsonData
                });

                // Handle the API response
                var responseData = await response.json();
                console.log('API Response:', responseData.status);
                var whatsappMessage = `Hello! My vehicle registration number is ${rcNumber}.`;

                // Construct the WhatsApp link
                var whatsappLink = `https://wa.me/918448850166?text=${encodeURIComponent(whatsappMessage)}`;

                // Redirect to the WhatsApp link
                window.location.href = whatsappLink;
                // You can perform further actions based on the API response

            } catch (error) {
                console.error('Error:', error);
            } finally {
                // Enable the submit button and hide the loading spinner
                document.getElementById('loadingSpinner').style.display = 'none';
                document.querySelector('.btn-solid').disabled = false;
            }
        }
    }
</script>