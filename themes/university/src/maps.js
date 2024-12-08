// function initMap(markers, initials) {
//   // Map options
//   var options = {
//     zoom: 10,
//     center: initials,
//   };

//   // New map
//   var map = new google.maps.Map(document.getElementById("map"), options);

//   // Loop through markers and add them to the map
//   markers.forEach(function (marker) {
//     addMarker(marker);
//   });

//   // Add marker function
//   function addMarker(props) {
//     var marker = new google.maps.Marker({
//       position: props.coords,
//       map: map,
//     });

//     // Check for content
//     if (props.content) {
//       var infoWindow = new google.maps.InfoWindow({
//         content: props.content,
//       });

//       marker.addListener("click", function () {
//         infoWindow.open(map, marker);
//       });
//     }
//   }

//   regionModal.show();
// }

function initMap($el) {
  // Find marker elements within map.
  var $markers = $el.find(".marker");

  // Create gerenic map.
  var mapArgs = {
    zoom: $el.data("zoom") || 16,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };
  var map = new google.maps.Map($el[0], mapArgs);

  // Add markers.
  map.markers = [];
  $markers.each(function () {
    initMarker($(this), map);
  });

  // Center map based on markers.
  centerMap(map);

  // Return map instance.
  return map;
}

function initMarker($marker, map) {
  // Get position from marker.
  var lat = $marker.data("lat");
  var lng = $marker.data("lng");
  var latLng = {
    lat: parseFloat(lat),
    lng: parseFloat(lng),
  };

  // Create marker instance.
  var marker = new google.maps.Marker({
    position: latLng,
    map: map,
  });

  // Append to reference for later use.
  map.markers.push(marker);

  // If marker contains HTML, add it to an infoWindow.
  if ($marker.html()) {
    // Create info window.
    var infowindow = new google.maps.InfoWindow({
      content: $marker.html(),
    });

    // Show info window when marker is clicked.
    google.maps.event.addListener(marker, "click", function () {
      infowindow.open(map, marker);
    });
  }
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
function centerMap(map) {
  // Create map boundaries from all map markers.
  var bounds = new google.maps.LatLngBounds();
  map.markers.forEach(function (marker) {
    bounds.extend({
      lat: marker.position.lat(),
      lng: marker.position.lng(),
    });
  });

  // Case: Single marker.
  if (map.markers.length == 1) {
    map.setCenter(bounds.getCenter());

    // Case: Multiple markers.
  } else {
    map.fitBounds(bounds);
  }
}

document.addEventListener("load", function () {
  console.log("loaded");
});

// Render maps on page load.
$(document).ready(function () {
  $(".acf-map").each(function () {
    var map = initMap($(this));
  });
});
