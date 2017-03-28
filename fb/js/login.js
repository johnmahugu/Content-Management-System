$("#signup").click(function(){

var url = 'https://www.facebook.com/dialog/oauth?client_id=630668270421013&redirect_uri=http://localhost:7777/content-management-swag/fb/publish.php&scope=email,user_about_me,publish_pages,publish_actions,manage_pages';

//	var purl="https://graph.facebook.com/oauth/access_token?"
    //    . "client_id=630668270421013&redirect_uri=http://localhost:7777/content-management-swag/fb/publish.php/?fbTrue=true&client_secret=d7aadb2b243fdce91134f3470413ee50&code=" . $_GET['code'];


$( location ).attr("href", url);
/*
$.ajax({
    url: url,
    dataType: 'json',
    success: function(data, status) {
      $( '#output' ).html('Username: ' + data.username);
    },
    error: function(data, e1, e2) {
      $( '#output' ).html(e2);
    }
})	
*/
  });


