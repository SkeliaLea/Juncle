var map; //google map variable declaration
var polylineList = []; // ArrayList of LatLng para drawing sa polylines
let polylineDrawing;
var count = 0 ;
var coordinateList= [];
let markers = [];


function myMap() {
var mapProp= {
  center:new google.maps.LatLng(10.297317009817453,123.89707367672831),
  zoom:15,
};
 map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

 var marker = new google.maps.Marker({ // mag create og marker
    position: mapProp,
    map: map,
  });


  
  google.maps.event.addListener(map, 'click', function(event) { //click listener on the map
    if(count != 4 ){
        placeMarker(event.latLng); // calling placeMarker function every click
        drawPolyline(event.latLng); // calling drawPolyline functtion every click
        count++;
     }
  });


}

function drawPolyline(latLng) {
    polylineList.push(latLng); // addling the latLng to the polylineList

    if (polylineList.length == 4) { // if 4 na ang coordinates points, iadd sa polylineList ang pinaka first nga coordinate point para mahimo syang square
      polylineList.push(polylineList[0]);
    }

  polylineDrawing = new google.maps.Polyline({ //drawing the polyline
      path: polylineList,
      geodesic: false,
      strokeColor: "#FF0000",
      strokeOpacity: 1.0,
      strokeWeight: 1,
    });

    polylineDrawing.setMap(map);

  } // end of drawPolyLine();



  function placeMarker(location) {
     var marker = new google.maps.Marker({
      position: location,
      map: map

    });
    markers.push(marker);
    let tempStrLoc = location.toString(); 
    let newStrLoc= tempStrLoc.replace(/[,()]/g, "");
    const myArrayLoc = newStrLoc.split(" ");
    coordinateList.push( myArrayLoc[0]);
    coordinateList.push( myArrayLoc[1]);
    console.log("LatLng: " + JSON.stringify(location));


    // console.log("lat-topLeft: " +  coordinateList[0]);
    // console.log("lng-topLeft: " +  coordinateList[1]);
    // console.log("lat-topRight: " +  coordinateList[2]);
    // console.log("lng-TopRight: " +  coordinateList[3])
    // console.log("lat-botLeft: " +  coordinateList[4]);
    // console.log("lng-botLeft: " +  coordinateList[5])
    // console.log("lat-botRight: " +  coordinateList[6]);
    // console.log("lng-botRight: " +  coordinateList[7])
    
    $("#loc-lattopleft").val(coordinateList[0]); 
    $("#loc-lngtopleft").val(coordinateList[1]); 
    $("#loc-lattopright").val(coordinateList[2]); 
    $("#loc-lngtopright").val(coordinateList[3]); 
    $("#loc-latbottomleft").val(coordinateList[4]); 
    $("#loc-lngbottomleft").val(coordinateList[5]); 
    $("#loc-latbottomright").val(coordinateList[6]); 
    $("#loc-lngbottomright").val(coordinateList[7]); 

    // 
    // let topLeft = str.replace(/[,()]/g, "");


    // const myArray = topLeft.split(" ");


    // $("#loc-lattopleft").val(myArray[0]); 
    // $("#loc-lattopright").val(myArray[1]); 
  }

  function removeMarkers(){
    for(i=0; i<markers.length; i++){
        markers[i].setMap(null);
        count=0;
    }
    map.clear
    polylineList = [];
    coordinateList=[];
    polylineDrawing.setMap(null);

   
}
function removePolylines(){
 
}
  function test(){alert("test");removeMarkers(); removePolylines();}
  