<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

    <script type="text/javascript" src="{{URL::asset('/js/markerclusterer.js')}}"></script>
  </head>
  <body>
    <div id="map"></div>
    <script type="text/javascript">
      var locations = "{{$postings}}";
      locations = locations.replace(/&quot;/g,'"');
      locations = JSON.parse(locations);

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
          center: {lat: -28.024, lng: 140.887}
        });

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
          return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length]
          });
        });

        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: '{{URL::asset('/images/m')}}'});
      


      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiqLhTVuJdNTI98ByAZDMLF0ly9M0m3qs&callback=initMap"
    async defer></script>
  </body>
</html>