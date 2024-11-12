// noinspection JSUnresolvedReference

function $(document) {

}

$(document).ready(function() {
    $('#registrationForm').on('submit', function(event) {
        event.preventDefault();

        const email = $('#email').val();
        const password = $('#password').val();


        if (!email.includes('@')) {
            $('#error-message').html('Invalid email format. Please enter a valid email address.');
            return;
        }

        $.ajax({
            url: 'submit.php',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if (response.success) {
                    alert('Validation successful!');
                } else {
                    $('#error-message').html(response.error);
                }
            },
            error: function() {
                alert('An error occurred.');
            }
        });
    });
});
