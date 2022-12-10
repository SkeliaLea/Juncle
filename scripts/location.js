



 $(document).ready(function(){
    $("#edit-schedule-form").hide();
    $("#edit-location-form").hide();    
    reloadData();


 });



 $(document).ready(function(){
    $("#add-location-btn").click(function(){ 
        if($("#location-name").val().length ==0){
            alert(" Location must not be empty!");
        }
        else {
            let location = $("#location-name").val();
            let lattopleft  = $("#loc-lattopleft").val();
            let lngtopleft= $("#loc-lngtopleft").val();
            let lattopright= $("#loc-lattopright").val();
            let lngtopright= $("#loc-lngtopright").val();
            let latbottomright= $("#loc-latbottomright").val();
            let lngbottomright= $("#loc-lngbottomright").val();
            let latbottomleft= $("#loc-latbottomleft").val();
            let lngbottomleft= $("#loc-lngbottomleft").val();

            $.ajax({
                type: "POST",
                url: "./functions/location/store_locationdata.php",
                data: {
                    location: location,
                    lattopleft :lattopleft,
                    lngtopleft :lngtopleft,
                    lattopright : lattopright,
                    lngtopright : lngtopright,
                    latbottomright :latbottomright,
                    lngbottomright : lngbottomright,
                    latbottomleft : latbottomleft,
                    lngbottomleft : lngbottomleft
                },
                success: function(result){
                    alert("Data Added");
                    reloadData();				
                       
                }
            })
   
         
        }
        
    }); 

});



// delete schedule reload
$(document).on('click' ,"#delete-location",function(){
    let id = $(this).val();
    $.ajax({
        type: "POST", 
        url: "./functions/location/delete_locationdata.php",
        data:{
            id : id
        },
        cache: false, 
        success: function(dataResult){
            //$("#no-schedule-form").hide();
            alert("Data Deleted"); 
            reloadData();
        }
    });
});



$(document).on('click', '#location-table tr', function() {
    $("#edit-schedule-form").hide();
    $("#edit-location-form").show();
    $('#no-schedule-form').hide();
    let currentRow=$(this).closest("tr"); 
    let location_id =currentRow.find("td:eq(1)").text();  // Schedule ID
    let location_name = currentRow.find("td:eq(2)").text();
    let lat_top_left = currentRow.find("td:eq(3)").text();
    let lng_top_left= currentRow.find("td:eq(4)").text();
    let lat_top_right= currentRow.find("td:eq(5)").text();
    let lng_top_right= currentRow.find("td:eq(6)").text();
    let lat_bottom_right= currentRow.find("td:eq(7)").text();
    let lng_bottom_right= currentRow.find("td:eq(8)").text();
    let lat_bottom_left= currentRow.find("td:eq(9)").text();
    let lng_bottom_left= currentRow.find("td:eq(10)").text();

    $("#edit-location-id").val(location_id);
    $("#edit-location-name").val(location_name);
    $("#editloc-lattopleft").val(lat_top_left);
    $("#editloc-lngtopleft").val(lng_top_left);
    $("#editloc-lattopright").val(lat_top_right);
    $("#editloc-lngtopright").val(lng_top_right);
    $("#editloc-latbottomright").val(lat_bottom_right);
    $("#editloc-lngbottomright").val(lng_bottom_right);
    $("#editloc-latbottomleft").val(lat_bottom_left);
    $("#editloc-lngbottomleft").val(lng_bottom_left);

 
});
$(document).on('click',"#submit-edit-location",function(){  
    if($("#edit-location-name").val().length ==0){
        alert(" Location must not be empty!");
    }
    else {
        let id = $("#edit-location-id").val();
        let location = $("#edit-location-name").val();
        let lattopleft  = $("#editloc-lattopleft").val();
        let lngtopleft= $("#editloc-lngtopleft").val();
        let lattopright= $("#editloc-lattopright").val();
        let lngtopright= $("#editloc-lngtopright").val();
        let latbottomright= $("#editloc-latbottomright").val();
        let lngbottomright= $("#editloc-lngbottomright").val();
        let latbottomleft= $("#editloc-latbottomleft").val();
        let lngbottomleft= $("#editloc-lngbottomleft").val();

        $.ajax({
            type: "POST",
            url: "./functions/location/update_locationdata.php",
            data: {
                id : id,
                location: location,
                lattopleft :lattopleft,
                lngtopleft :lngtopleft,
                lattopright : lattopright,
                lngtopright : lngtopright,
                latbottomright :latbottomright,
                lngbottomright : lngbottomright,
                latbottomleft : latbottomleft,
                lngbottomleft : lngbottomleft
            },
            success: function(result){
                alert("Data updated");
                reloadData();				
                   
            }
        })

     
    }

});




function reloadData() {
    $("#edit-schedule-form").hide();
    $(document).ready(function() {
        $.ajax({ 

            method: "POST", 
            
            url: "./functions/location/load_data_location.php",

        }).done(function( data ) { 


            let result= $.parseJSON(data); 
            let string=' <table id="location-table" style="text-align:center;"class="table table-hover"width="100%"><tr><th>Action</th> <th>Location ID</th><th>Location Name</th>  <th>Latitude Top Left</th> <th>Longitude Top Left</th>  <th>Latitude Top Right</th> <th>Longitude Top Right</th> <th>Latitude Bottom Right</th>  <th>Longitude Bottom Right</th> <th>Latitude Bottom Left</th>  <th>Longitude Bottom Left</th><tr>';
    
        /* from result create a string of data and append to the div */
        
            $.each( result, function( key, value ) { 
                    
                string += "<tr><td><button type='button' class='btn btn-warning' id='location-edit' value='"+value['location_id']+"'><ion-icon name='create-outline'></ion-icon></button><button type='button' class='btn btn-danger'  id='delete-location' name='delete' value = '"+value['location_id']+"'> <ion-icon name='trash-outline'></ion-icon></button> </td><td>"+value['location_id'] + "</td><td>" +value['location_name']+'</td><td> '+value['lat_top_left']+'</td><td>'+value['lng_top_left']+'</td><td>'+value['lat_top_right']+'</td><td>'+value['lng_top_right']+'</td><td>'+value['lat_bottom_right']+'</td><td>'+value['lng_bottom_right']+'</td><td>'+value['lat_bottom_left']+'</td><td>'+value['lng_bottom_left']+"</td></tr>"; 
            }); 

                string += '</table>'; 

            $("#data").html(string); 
        }); 
    });

 

}