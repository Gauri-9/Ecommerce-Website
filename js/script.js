$(document).ready(function() {
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

    function validateEmail() {
        let email = $('#email').val();
        if (!emailPattern.test(email)) {
            $('#emailError').text('Invalid email format.');
            return false;
        } else {
            $('#emailError').text('');
            return true;
        }
    }

    
function validatePassword() {
        let password = $('#password').val();
        if (!passwordPattern.test(password)) {
            $('#passwordError').text('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.');
            return false;
        } else {
            $('#passwordError').text('');
            return true;
        }
    }


$('#email').on('input', validateEmail);
    $('#password').on('input', validatePassword);

    $('#registrationForm').on('submit', function(event) {
        if (validateEmail() && validatePassword()) {
            $('#message').html('<div class="alert alert-success">Registration successful!</div>');
            return true; // Allow form submission
        } else {
            $('#message').html('<div class="alert alert-danger">Please correct the errors and try again.</div>');
            return false; // Prevent form submission
        }
        alert();
        $('.filter-button').on('click', function(){
            var filterValue = $(this).attr('data-filter');
            if(filterValue == 'all') {
                $('.product-card').show();
            } else {
                $('.product-card').not('.' + filterValue).hide();
                $('.product-card').filter('.' + filterValue).show();
            }
    
    });

    const stockQuantity = 50; // Example stock quantity
    let currentQuantity = 1;

    $('#increment').click(function() {
        if (currentQuantity < stockQuantity) {
            currentQuantity++;
            $('#quantity').val(currentQuantity);
        }
    });

    $('#decrement').click(function() {
        if (currentQuantity > 1) {
            currentQuantity--;
            $('#quantity').val(currentQuantity);
        }
    });

    $('#add-to-cart').click(function() {
        alert('Product added to cart.');
    });

    $('#buy-now').click(function() {
        alert('Proceeding to checkout.');
    });


//checkout code

$('#price, #quantity').on('input', function () {
                var price = parseFloat($('#price').val()) || 0;
                var quantity = parseFloat($('#quantity').val()) || 0;
                $('#totalPrice').val(price * quantity);
            });

            // Validate form on submit
            $('#checkoutForm').on('submit', function (e) {
                e.preventDefault();
                var isValid = true;

                // Full Name validation
                if ($('#fullName').val().trim() === '') {
                    isValid = false;
                    alert('Full Name is required.');
                }

                // Address validation
                if ($('#address').val().trim() === '') {
                    isValid = false;
                    alert('Address is required.');
                }
                // Email validation
                var email = $('#email').val();
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    isValid = false;
                    alert('Please enter a valid email address.');
                }

                // User ID validation
                if ($('#userId').val().trim() === '') {
                    isValid = false;
                    alert('User ID is required.');
                }

                // Price and Quantity validation
                if ($('#price').val() <= 0 || $('#quantity').val() <= 0) {
                    isValid = false;
                    alert('Price and Quantity must be greater than zero.');
                }

                // Debit Card Number validation
                var cardNumber = $('#cardNumber').val();
                var cardPattern = /^[0-9]{16}$/;
                if (!cardPattern.test(cardNumber)) {
                    isValid = false;
                    alert('Please enter a valid 16-digit debit card number.');
                }
                // CVV validation
                var cvv = $('#cvv').val();
                var cvvPattern = /^[0-9]{3}$/;
                if (!cvvPattern.test(cvv)) {
                    isValid = false;
                    alert('Please enter a valid 3-digit CVV.');
                }

                // Expiry Date validation
                var expiryDate = $('#expiryDate').val();
                var expiryPattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
                if (!expiryPattern.test(expiryDate)) {
                    isValid = false;
                    alert('Please enter a valid expiry date (MM/YY).');
                }

                if (isValid) {
                    alert('Form submitted successfully!');
                    // You can add AJAX request here to submit the form data to your server
                }
            });
});

