 /* Location  Maps
**********************************************/

// MAPS
var maps = [];
var gmarkers = [];
var globalwindow;
var default_zoom = 12;


$( document ).ready(function() {

  $('.dynamic-map').each(function(){
    render_location_map( $(this) );
  });

  var $locations = $('.location_container');
  $locations.imagesLoaded( function(){
    $locations.isotope({
      itemSelector: '.location',
      gutter: 0,
      layoutMode: 'packery',
      isFitWidth: true
    });
  });
  $('.location_filter').on( 'click', 'li', function() {
    var $this  = $(this);
    $this.addClass('active').siblings().removeClass('active');
    var filter_class = $this.data('filter');
    $locations.isotope({ filter: filter_class });
    $locations.on( 'arrangeComplete', function( event, filteredItems ) {
      map_filter_render($this, filteredItems)
    });
  });
  $('.location' ).on( "click", function(e) {
    var $this = $( this );
    var $parent = $this.closest('.locations');
    var map = $parent.data('map');
    var $map_object = get_map_object_by_id(map);
    var $map_div = $('.'+map);
    var index = $this.data('index');
    var marker = $map_object.markers[index];
    var infowindow = new google.maps.InfoWindow({
      content   : $this.html(),
      maxWidth: 300
    });
    if (globalwindow) {
      globalwindow.close();
    }
    infowindow.open( $map_object, marker );
    $map_object.panTo(marker.getPosition());
    globalwindow = infowindow;
    goToByScroll($parent);
  });

  $('.location a' ).on( "click", function(e) {
    e.stopPropagation();
  });
});

// Re render map when filter is pressed
function map_filter_render($this, filteredItems) {
  var $parent = $this.closest('.locations');
  var map = $parent.data('map');
  var $map_object = get_map_object_by_id(map);
  remove_all_markers($map_object);
  var index = 0;
  $parent.find('.location').each(function(){
    var $this = $(this);

    if($this.is(":visible")) {
      $this.data('index', index);
      add_dynamic_marker( $this, $map_object, $this.html() );
      index++;
    }
  });
  center_dynamic_map( $map_object );
  gmarkers = [];
}


function render_location_map( $el ) {
  var $markers = $el.find('.marker');
  var args = {
    zoom    : default_zoom,
    scrollwheel: false,
    center    : new google.maps.LatLng(43.0667, -89.4000),
    mapTypeId : google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: false
  };
  var map = new google.maps.Map( $el[0], args);
  map.markers = [];
  $parent = $el.closest('.locations');
  $parent.find('.location').each(function(){
    var $this = $(this);
    add_dynamic_marker( $this, map, $this.html() );

  });
  center_dynamic_map( map );
  maps.push({map_name:$el.data('map'), map_object:map });
}




function center_dynamic_map( map ) {
  var bounds = new google.maps.LatLngBounds();
  $.each( map.markers, function( i, marker ){
    var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
    bounds.extend( latlng );
  });
  if( map.markers.length < 1 ) { }
  else if( map.markers.length == 1 ) { // if theres only one map marker
    map.setCenter( bounds.getCenter() );
  }
  else {
    map.fitBounds( bounds );
  }
}



function add_dynamic_marker( $marker, map, info ) {
  var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
  var marker;
  marker = new google.maps.Marker({
    position  : latlng,
    map     : map
  });
  map.markers.push( marker );
  gmarkers.push(marker);
  if( info ) {
    var infowindow = new google.maps.InfoWindow({
      content   : info,
      maxWidth: 300
    });
    google.maps.event.addListener(marker, 'click', function() {
      if (globalwindow) { globalwindow.close();    }
      infowindow.open( map, marker );
      map.panTo(marker.getPosition());
      globalwindow = infowindow;
    });
  }
}

function remove_all_markers(map) {
  for (var i = 0; i < map.markers.length; i++) { map.markers[i].setMap(null); }
  map.markers = [];
}


function get_map_object_by_id(map) {
  var numMaps = maps.length;
  var $map_object;
  for (var i = 0; i < numMaps; i++) {
    $current_map = maps[i];
    if ($current_map['map_name'] == map) {
      $map_object = $current_map['map_object'];
    }
  }
  return $map_object;
}

function goToByScroll($div){
  $('html,body').animate({ scrollTop: $div.offset().top - 50}, 'slow');
}
