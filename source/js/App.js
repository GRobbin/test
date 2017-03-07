$(function(){ 
		//Get list on document ready. Change later to 'if search input empty GET list'.

		 $.getJSON("products.php", function(data){ 
            /* loop through array */
           	$.each(data, function(index, d){            
                $('<tr />').append(
               	$('<td />').text(d.name),
               	$('<td />').text(d.group),
               	$('<td />').html("<a href='"+d.url+"'>"+'Read more'+"</a>")
               	).appendTo('.search-table');
            });
        });

		 //When search input is changed, SEND new search query and GET new result

		 $('input[type=search]').keyup(function(){
		    var value = $( this ).val();
		 	
		 	$.getJSON("products.php", { s:value }, function(data){
			 $.each(data, function(index, d){            
                $('<tr />').replaceAll(
               	$('<td />').text(d.name),
               	$('<td />').text(d.group),
               	$('<td />').html("<a href='"+d.url+"'>"+'Read more'+"</a>")
               	).appendTo('.search-table');
            });	
	 	});
	});
});