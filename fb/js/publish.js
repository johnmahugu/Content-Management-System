
$( document ).ready(function() { 

function add(options){
        
        var result = $.parseJSON(options);
        for(var index in result) {
        var str="<option id="+index+">"+result[i].[index]+"'</option>"
        $("#pages").append(str);
	
        	}
    }


});