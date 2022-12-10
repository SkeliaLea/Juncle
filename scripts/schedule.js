$(function () {
    $( "#bookingLimit" ).change(function() {
       var max = parseInt($(this).attr('max'));
       var min = parseInt($(this).attr('min'));
       if ($(this).val() > max)
       {
           $(this).val(max);
       }
       else if ($(this).val() < min)
       {
           $(this).val(min);
       }       
     }); 
 });

 $(function () {
    $( "#booking-limit" ).change(function() {
       var max = parseInt($(this).attr('max'));
       var min = parseInt($(this).attr('min'));
       if ($(this).val() > max)
       {
           $(this).val(max);
       }
       else if ($(this).val() < min)
       {
           $(this).val(min);
       }       
     }); 
 });


$(document).on('click',  '#cancel-edit', function(){
     $("#table_data").find("input,button,textarea,select").removeAttr("disabled");
     $("#no-schedule-form").show();
     $("#edit-schedule-form").hide();
     $("#edit-location-form").hide();  
});



$(document).on('click', '#submit-edit', function(){
    $("#table_data").find("input,button,textarea,select").removeAttr("disabled");
    $("#edit-schedule-form").hide();
    $("#edit-location-form").hide();  

    let schedule_id =  $("#schedule-id").text();
    let location = $("#edit-pickup-location").val();
    let date = $("#edit-pickup-date").val();
    let collector = $("#edit-selected-collector").val();
    let status = $("#edit-schedule-status").val();
    let limit = $("#booking-limit").val();


   

    $.ajax({
        type: "POST",
        url: "./functions/schedule/update_scheduledata.php",
        data: {
        schedule_id : schedule_id,
           location: location,
           date: date,
           collector : collector,
           limit : limit, 
           status : status,
            // lattopleft :lattopleft ,
            // lngtopleft:lngtopleft,
            // lattopright:lattopright,
            // lngtopright:lngtopright,
            // latbottomright:latbottomright,
            // lngbottomright:lngbottomright,
            // latbottomleft:latbottomleft,
            // lngbottomleft:lngbottomleft
        },
        cache: false,
        success: function(dataResult){
            window.location.reload(true);
            location.reload(true); 	
            alert("Mesage");
            reloadData();
          		   
        }
    })

});


$(document).on('click', "#edit-schedule", function () {
    $("#edit-location-form").hide(); 
    $("#table_data").find("input,button,textarea,select").attr("disabled", "disabled");

    $("#edit-schedule-form").show();
    $("#no-schedule-form").hide();
   
    let currentRow=$(this).closest("tr"); 
    let schedule_id =currentRow.find("td:eq(1)").text();  // Schedule ID
    let collector_id = currentRow.find("td:eq(2)").attr('id');

    let location =currentRow.find("td:eq(3)").attr('id');  // pick Location
    let date =currentRow.find("td:eq(4)").text();  // Pick up date
    let current_limit =currentRow.find("td:eq(5)").text(); 
    let status =currentRow.find("td:eq(6)").text();  // schedule status

    // let lattopleft  = currentRow.find("td:eq(7)").text();
    // let lngtopleft=  currentRow.find("td:eq(8)").text();
    // let lattopright=currentRow.find("td:eq(9)").text();
    // let lngtopright= currentRow.find("td:eq(10)").text();
    // let latbottomright= currentRow.find("td:eq(11)").text();
    // let lngbottomright=currentRow.find("td:eq(12)").text();
    // let latbottomleft= currentRow.find("td:eq(13)").text();
    // let lngbottomleft=  currentRow.find("td:eq(14)").text();

    let valueDate = date.slice(0,10);

    $("#schedule-id").html(schedule_id);
    $("#edit-pickup-location").val(location);
    $("#edit-pickup-date").val(valueDate);
    $("#edit-selected-collector").val(collector_id).change();
    $("#booking-limit").val(current_limit).change();

    // $("#editlattopleft").val(lattopleft);
    // $("#editlngtopleft").val(lngtopleft);
    // $("#editlattopright").val(lattopright);
    // $("#editlngtopright").val(lngtopright);
    // $("#editlatbottomright").val(latbottomright);
    // $("#editlngbottomright").val(lngbottomright);
    // $("#editlatbottomleft").val(latbottomleft);;
    // $("#editlngbottomleft").val(lngbottomleft);
    



    
}); 

// delete schedule reload
$(document).on('click' ,"#delete-schedule",function(){
    let id = $(this).val();
    $.ajax({
        type: "POST", 
        url: "./functions/schedule/delete_scheduledata.php",
        data:{
            id : id
        },
        cache: false, 
        success: function(dataResult){
            $("#no-schedule-form").hide();
            location.reload(true); 
            reloadData();
        }
    });
});

// Add schedule
 $(document).ready(function(){
    $("#add-schedule").click(function(){ 
        if($("#pickupLocation").val().length ==0){
            alert("Pick-up Location must not be empty!");
        }
        else {
            let location = $("#pickupLocation").val();
            let date = $("#pickupDate").val();
            let collector = $("#selectedCollector").val();
            let status = $("#scheduleStatus").val();
            let max = $("#bookingLimit").val();

            // let lattopleft  = $("#lattopleft").val();
            // let lngtopleft= $("#lngtopleft").val();
            // let lattopright= $("#lattopright").val();
            // let lngtopright= $("#lngtopright").val();
            // let latbottomright= $("#latbottomright").val();
            // let lngbottomright= $("#lngbottomright").val();
            // let latbottomleft= $("#latbottomleft").val();
            // let lngbottomleft= $("#lngbottomleft").val();

            $.ajax({
                type: "POST",
                url: "./functions/schedule/store_scheduledata.php",
                data: {
                    location: location,
                    date: date,
                    collector : collector, 
                    status : status,
                    max : max,
                    // lattopleft :lattopleft,
                    // lngtopleft :lngtopleft,
                    // lattopright : lattopright,
                    // lngtopright : lngtopright,
                    // latbottomright :latbottomright,
                    // lngbottomright : lngbottomright,
                    // latbottomleft : latbottomleft,
                    // lngbottomleft : lngbottomleft
                },
                cache: false,
                success: function(dataResult){
                    location.reload(true); 
                    reloadData();
                        alert(dataResult);				
                       
                }
            })
   
         
        }
    }); 

});


function reloadData() {
    
    $(document).ready(function() {
        $.ajax({ 

            method: "POST", 
            
            url: "./functions/schedule/load_scheduledata.php",

        }).done(function( data ) { 


            let result= $.parseJSON(data); 
            let string=' <table style="text-align:center;"class="table table-hover"width="100%"><tr> <th>Schedule ID</th><th>Collector</th> <th>Pick-up Area</th> <th>Pick-up Date</th><th>Max Booking</th><th>Status</th>  <th>Latitude Top Left</th> <th>Longitude Top Left</th>  <th>Latitude Top Right</th> <th>Longitude Top Right</th> <th>Latitude Bottom Right</th>  <th>Longitude Bottom Right</th> <th>Latitude Bottom Left</th>  <th>Longitude Bottom Left</th><th>Action</th><tr>';
    
        /* from result create a string of data and append to the div */
        
            $.each( result, function( key, value ) { 
                    
                string += "<tr><td>"+value['schedule_id'] + "</td><td class ='test' id="+value['collector_id']+">" +value['collector_firstname']+' '+value['collector_lastname']+'</td><td id="pickupLocation">'+value['pickup_area']+'</td><td>'+value['pickup_date']+'</td><td>'+value['max_booking']+'</td><td>'+value['schedule_status']+'</td><td><button type="button" class="btn btn-warning" id="edit-schedule"  value = '+value['schedule_id']+'><ion-icon name="create-outline"></ion-icon></button><button type="button" class="b-danger"  id="delete-schedule" name="delete" value = '+value['schedule_id']+"> <ion-icon name='trash-outline'></ion-icon></button> </tr>"; 
            }); 

                string += '</table>'; 

            $("#table-form").html(string); 
        }); 
    });

 

}


$(document).ready(function() {

        $("#edit-schedule-form").hide();
        $("#no-schedule-form").show();
    $.ajax({ 

        method: "POST", 
        url: "./functions/schedule/load_scheduledata.php",

  }).done(function( data ) { 


        let result= $.parseJSON(data); 

        let string=' <table style="text-align:center;"class="table table-hover"width="100%"><tr> <th>Schedule ID</th><th>Collector</th> <th>Pick-up Area</th> <th>Pick-up Date</th><th>Max Booking</th><th>Status</th>  <th>Latitude Top Left</th> <th>Longitude Top Left</th>  <th>Latitude Top Right</th> <th>Longitude Top Right</th> <th>Latitude Bottom Right</th>  <th>Longitude Bottom Right</th> <th>Latitude Bottom Left</th>  <th>Longitude Bottom Left</th><th>Action</th><tr>';
 
       /* from result create a string of data and append to the div */
      
        $.each( result, function( key, value ) { 
                 
            string += "<tr class='table-schedule-data'><td>"+value['schedule_id'] + "</td><td class ='test' id="+value['collector_id']+">" +value['collector_firstname']+' '+value['collector_lastname']+'</td><td id="pickupLocation">'+value['pickup_area']+'</td><td>'+value['pickup_date']+'</td><td>'+value['max_booking']+'</td><td>'+value['schedule_status']+'</td><td class="d-flex align-items-center"><button type="button" class="btn btn-warning" id="edit-schedule"  value = '+value['schedule_id']+'><ion-icon name="create-outline"></ion-icon></button><button type="button" class="btn btn-danger"  id="delete-schedule" name="delete" value = '+value['schedule_id']+"> <ion-icon name='trash-outline'></ion-icon></button></td></tr>"; 
         }); 

             string += '</table>'; 

          $("#table-form").html(string); 
  }); 
   

    // $(document).ready(function(){

    //     load_data();

    //     function load_data(query)
    //     {
    //         $.ajax({
    //             url:"./functions/schedule/fetch.php",
    //             method:"POST",
    //             data:{query:query},
    //             success:function(data)
    //         {
    //             $('#table-form').html(data);
    //         }
    //         });
    //         }
    //             $('#search_text').keyup(function(){
    //             let search = $(this).val();
    //         if(search != '')
    //         {
    //         load_data(search);
    //         }
    //         else
    //         {
    //         load_data();
    //         }
    //     });
    // });

});
