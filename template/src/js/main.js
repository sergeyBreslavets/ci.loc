

 $( "#datetimepicker1 input" ).datepicker({ // для календаря
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            altField: "#calendarDateField",
            altFormat: "yy-mm-dd"});  
      $( "#datetimepicker1 .input-group-addon" ).click(function() { 
            $( "#datetimepicker1 input" ).datepicker( "show" ); 
        
       });

       $( "#datetimepicker2 input" ).datepicker({ // для календаря
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            altField: "#calendarDateField",
            altFormat: "yy-mm-dd"});  
      $( "#datetimepicker2 .input-group-addon" ).click(function() { 
            $( "#datetimepicker2 input" ).datepicker( "show" ); 
        
       });
