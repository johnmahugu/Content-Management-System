$(document).ready(function() {
    $('#add').hide();
    $.ajax({
        type: 'POST',
        url: 'http://localhost:7777/content-management-swag/registration/reg.php',
        success: function(list) {
            var json = $.parseJSON(list);
            for (var i = 0; i < json.length; ++i) {
                $('#list').append("<tr><td><input size='6 type='text' class='id' value=" + json[i].id + "></td><td><input size='6 type='text' class='name' value=" + json[i].name + ">" +
                    "</td><td><input size='6 type='text' class='roll_no' value=" + json[i].roll_no + "></td><td><input size='6 type='text' class='div' value=" + json[i].div + ">" +
                    "</td><td><input size='6 type='text' class='mob' value=" + json[i].mob + "></td><td><input size='6 type='text'  class='email_id'value=" + json[i].email_id + ">" +
                    "</td><td><input size='6 type='text' class='receipt_no' value=" + json[i].receipt_no + "></td><td><input size='6 type='text' class='board_mem' value=" + json[i].board_mem + ">" +
                    "</td><td><input type='button' class='save' value='save' onClick='save()'></td><td><input type='button' class='del' value='Delete'></td></tr>");
                $(".del").bind("click", del);

            }

        }
    });
    $(".del").bind("click", del);
    $('#new').click(function() {
        $('#add').show();

        $("#add").on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'http://localhost:7777/content-management-swag/registration/add.php',
                data: $(this).serialize(),
                success: function(msg) {
                    $('#result').html(msg);
                }
            });
        });
    });

});


/*    $('.save').click(function(){

var $row = $(this).parents('tr');
    var desc = $row.find('input[name="name"]').val();

    	var name=$(this).closest('tr').find('td:eq(1)').text();
    	//var name=$("#name",$(this).parent().parent()).val();
    	alert(desc);
    });
*/

function del() {
    var par = $(this).parent().parent(); //tr 
    par.remove();
};