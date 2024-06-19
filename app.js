
  $(document).ready(function(){
    $.ajax({
        url:"sample.php",
        method: "GET",
        success: function(data) {
        
                var employee = [];
                var order = [];
                var colors = [];

               for(var i in data) {
                employee.push(data[i].emp_name);
                order.push(data[i].date);
                colors.push(color());
               } 
               var chartdata = {
                labels: employee,
                datasets : [{
                    label: "booking data",
                    backgroundcolor: colors,
                    data: date}
                ]
               };
           
               var ctx = $("#mychart");
               var linegraph = new chart(ctx,{
                type: 'line',
                data: chartdata,
               });


        },
        error: function(data){
            console.log(data);
        }
    });
  });

      function color(){
        var r = Math.floor(Math.random()*256);
        var g = Math.floor(Math.random()*256);
        var b = Math.floor(Math.random()*256);

        var rgba = 'rgba('+r+','+g+','+b+'1.0)';
        return rgba;
      }