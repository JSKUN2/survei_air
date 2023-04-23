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

let lng;
let lat;

map.on('click', function(event) {
  
  var lnglat = ol.proj.transform(event.coordinate, 'EPSG:3857', 'EPSG:4326');
  lng = parseFloat(lnglat[0]);
  lat = parseFloat(lnglat[1]);

  if (markerLayer.getSource().getFeatures().length > 0) {
    markerLayer.getSource().clear();
  }

  var markerFeature = new ol.Feature({
    geometry: new ol.geom.Point(event.coordinate)
  });
  markerLayer.getSource().addFeature(markerFeature);

  console.log('Longitude:', lng, 'Latitude:', lat);

});


function inputData() {
  
  console.log('Longitude:', lng, 'Latitude:', lat);
  if (lng==null || lat==null) {
    alert("Pilih alamat anda dengan mengklik lokasi rumah anda pada map!");
    return false;
  }

  if (document.getElementById("nama").value=='') {
    alert("Masukkan nama!");
    return false;
  }

  if (document.getElementById("no_ktp").value=='') {
    alert("Masukkan no KTP!");
    return false;
  }

  if (document.getElementById("email").value=='') {
    alert("Masukkan email!");
    return false;
  }

  if ($("input[name=bau]:checked").val()==undefined) {
    alert("Pilih apakah air mempunyai bau atau tidak!");
    return false;
  }

  if ($("input[name=rasa]:checked").val()==undefined) {
    alert("Pilih apakah air mempunyai rasa atau tidak!");
    return false;
  }

  if ($("input[name=warna]:checked").val()==undefined) {
    alert("Pilih apakah air mempunyai warna atau tidak!");
    return false;
  }

  if ($("input[name=sumber]:checked").val()==undefined) {
    alert("Pilih sumber air!");
    return false;
  }
  
  no_ktp = document.getElementById("no_ktp").value;
  if (no_ktp.length > 16 || no_ktp.length < 16) {
    $.ajax({
        url: 'submit.php',
        type: 'POST',
        data: {
          'nama': document.getElementById("nama").value,
          'no_ktp': no_ktp,
          'email': document.getElementById("email").value,        
          'lng': lng,
          'lat': lat,
          'berasa': $("input[name='rasa']:checked").val(),
          'berwarna': $("input[name='warna']:checked").val() ,
          'berbau': $("input[name='bau']:checked").val(),
          'sumber': $("input[name='sumber']:checked").val()
        },
        success: function(response) {
          console.log('Data berhasil dikirim');
          window.location.href = 'terkirim.html';
        },
        error: function(xhr, status, error) {
          console.log('Terjadi kesalahan:', error);
        }
    });
  } else{alert("Tolong pastikan NIK anda 16 digit")}
}
