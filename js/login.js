$('#login_form').on("submit", function(data) {
    data.preventDefault();

    $.ajax({
        type: 'POST',
        url: 'login.php',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(formdata) {
            $(location).attr('href', 'index.php');
        }
    });


});