$(function(){ 
  //jQuery code here 
     $.getJSON("products.php", function(data){ 
            /* loop through array */
            $.each(data, function(index, d){            
                $('<tr />').append(
                $('<td />').text(d.name),
                $('<td />').text(d.group),
                $('<td />').html("<a href='"+d.url+"'>"+'Read more'+"</a>")
                ).appendTo('.load');
            });
        });
     /* loop through array on search */
     $('input[type=search]').keyup(function(){
        $('.load').empty();
        var value = $( this ).val();
      $.getJSON("products.php", { s:value }, function(data){
       $.each(data, function(index, d){            
                $('<tr />').append(
                $('<td />').text(d.name),
                $('<td />').text(d.group),
                $('<td />').html("<a href='"+d.url+"'>"+'Read more'+"</a>")
                ).appendTo('.load');
            }); 
    });
  });
});