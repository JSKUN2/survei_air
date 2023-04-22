var medanExtent = ol.proj.transformExtent([98.619903, 3.500321, 99.246361, 3.775940], 'EPSG:4326', 'EPSG:3857');
var deliSerdangExtent = ol.proj.transformExtent([98.4378, 3.3297, 99.0921, 3.6428], 'EPSG:4326', 'EPSG:3857');

var extent = ol.extent.extend(medanExtent, deliSerdangExtent);
var center = ol.proj.transform([98.6779, 3.6009], 'EPSG:4326', 'EPSG:3857');

var map = new ol.Map({
  target: 'map',
  layers: [
    new ol.layer.Tile({
      source: new ol.source.OSM()
    })
  ],
  view: new ol.View({
    center: center,
    zoom: 11,
    extent: extent
  })
});

var markerLayer = new ol.layer.Vector({
  source: new ol.source.Vector(),
  style: new ol.style.Style({
    image: new ol.style.Icon({
      anchor: [0.5, 1],
      src: 'marker.svg'
    })
  })
});
map.addLayer(markerLayer);

map.on('click', function(event) {
  var lnglat = ol.proj.transform(event.coordinate, 'EPSG:3857', 'EPSG:4326');
  var lng = lnglat[0];
  var lat = lnglat[1];

  if (markerLayer.getSource().getFeatures().length > 0) {
    markerLayer.getSource().clear();
  }

  var markerFeature = new ol.Feature({
    geometry: new ol.geom.Point(event.coordinate)
  });
  markerLayer.getSource().addFeature(markerFeature);

  // Tampilkan informasi long dan lat
  console.log('Longitude:', lng, 'Latitude:', lat);
  $.ajax({
    url: 'submit.php',
    type: 'POST',
    data: {
      'lng': lng,
      'lat': lat
    },
    success: function(response) {
      console.log('Data berhasil dikirim');
    },
    error: function(xhr, status, error) {
      console.log('Terjadi kesalahan:', error);
    }
  });
});
