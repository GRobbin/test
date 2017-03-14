$(function(){ 

      $.getJSON("products.php", function(data){ 

        /* Loop through array and append it to table */
        $.each(data, function(index, d){            
            $('<tr />').append(
            $('<td />').text(d.name),
            $('<td />').text(d.group),
            $('<td />').html("<a href='"+d.url+"'>"+'Read more'+"</a>")
            ).appendTo('.load');
        });
      });
   
      /* Prevent submiting form pressning Enter key */
      $('input[type=search]').keypress(function(){
      if(event.keyCode == 13) return false;
      });

     /* Loop through array on search and replace existing results */
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