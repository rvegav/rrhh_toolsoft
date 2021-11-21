  <div class="right_col" role="main">
    <div class="page-title">
      <div class="title_left">
        <h3>
         Marcacion de Personas
        </h3>
      </div>
    </div>
    <div class="clearfix">
    </div>
    <div class="row">
      <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <main role="main" class="inner cover">
          <div class="row">
            <button onclick="getLocation()">Marcar</button>

            <p id="demo"></p>
          </div>
          <div id="map_canvas" style="height:350px">

          </div>
        </main>

<!--     <footer class="mastfoot mt-auto">
      <div class="inner">
        <p><a href="https://estradawebgroup.com">Estrada Web Group</a>.</p>
      </div>
    </footer> -->
  </div>
</div></div>

<script>
  var x = document.getElementById("demo");
      function getLocation() {
        var today = new Date();
        var position = navigator.geolocation.getCurrentPosition(showPosition, showError);
        // console.log(posi);
        $.ajax({
          type:'POST',
          url:'<?php echo base_url()?>Marcacion/Marcacion/get',
          data: {
            fecha: today, position: position
          },
        })
        .done(function (html){
          $('#pantalla').html(html);
        })
        .fail(function(){
          alert('ocurrio un error interno, contacte con Rolo');
        });
        if (navigator.geolocation) {
        } else { 
          x.innerHTML = "Geolocation is not supported by this browser.";
        }
      }

      function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude;
        // x.innerHTML = today
        map = new google.maps.Map(document.getElementById('map_canvas'), {
          zoom: 14,
          center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        vMarker = new google.maps.Marker({
          position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
          draggable: true
        });
        google.maps.event.addListener(vMarker, 'dragend', function (evt) {
          $("#txtLat").val(evt.latLng.lat().toFixed(6));
          $("#txtLng").val(evt.latLng.lng().toFixed(6));

          map.panTo(evt.latLng);
        });
        map.setCenter(vMarker.position);
        vMarker.setMap(map);

      }

      function showError(error) {
        switch(error.code) {
          case error.PERMISSION_DENIED:
          x.innerHTML = "User denied the request for Geolocation."
          break;
          case error.POSITION_UNAVAILABLE:
          x.innerHTML = "Location information is unavailable."
          break;
          case error.TIMEOUT:
          x.innerHTML = "The request to get user location timed out."
          break;
          case error.UNKNOWN_ERROR:
          x.innerHTML = "An unknown error occurred."
          break;
        }
      }
    </script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWQzf597f8OnP38tMY4GgR9amiPhi7-ok"></script>
    <script>
      // var vMarker
      // var map
      // map = new google.maps.Map(document.getElementById('map_canvas'), {
      //   zoom: 14,
      //   center: new google.maps.LatLng(19.4326296, -99.1331785),
      //   mapTypeId: google.maps.MapTypeId.ROADMAP
      // });
      // vMarker = new google.maps.Marker({
      //   position: new google.maps.LatLng(19.4326296, -99.1331785),
      //   draggable: true
      // });
      // google.maps.event.addListener(vMarker, 'dragend', function (evt) {
      //   $("#txtLat").val(evt.latLng.lat().toFixed(6));
      //   $("#txtLng").val(evt.latLng.lng().toFixed(6));

      //   map.panTo(evt.latLng);
      // });
      // map.setCenter(vMarker.position);
      // vMarker.setMap(map);

      $("#txtCiudad, #txtEstado, #txtDireccion").change(function () {
        movePin();
      });

      function movePin() {
        var geocoder = new google.maps.Geocoder();
        var textSelectM = $("#txtCiudad").text();
        var textSelectE = $("#txtEstado").val();
        var inputAddress = $("#txtDireccion").val() + ' ' + textSelectM + ' ' + textSelectE;
        geocoder.geocode({
          "address": inputAddress
        }, function (results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            vMarker.setPosition(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
            map.panTo(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
            $("#txtLat").val(results[0].geometry.location.lat());
            $("#txtLng").val(results[0].geometry.location.lng());
          }

        });
      }
    </script>
<!-- </body>
</html> -->