function googleMapsApi(id){
  var mapOptions = {
          center: new google.maps.LatLng(-34.7051589, -58.5314522),
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
      this.map = new google.maps.Map(document.getElementById(id),mapOptions);

      
      this.setLocation = function(lat, lng){
          this.map.setCenter(new google.maps.LatLng(lat, lng));
          var marker = new google.maps.Marker({position:new google.maps.LatLng(lat, lng)});
              marker.setMap(this.map);
      }
}
function id(a){
  return document.getElementById(a);
}
function cls(a){
  return document.getElementsByClassName(a);
}
function Qsc(a){
  return document.querySelector(a);
}  

