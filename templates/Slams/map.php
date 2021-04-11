<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Date[]|\Cake\Collection\CollectionInterface $dates
 */
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>

<div class="dates index content">
    <h3>
        <?= __('Map') ?>
    </h3>
    <div class="row">
        <div class="column column-25">
            <ul class="map-list">
            <?php
                $slamCollection = new Cake\Collection\Collection($slams);
                $slamCollection = $slamCollection->combine('id',  function ($entity) { return $entity; }, 'state');
                foreach ($slamCollection as $state => $stateSlams) {
                    $stateSlams = new \Cake\Collection\Collection($stateSlams);
                    $stateSlams = $stateSlams->combine('id', 'title', 'city');
                    echo '<li>' . __($state) . '<ul>';
                    foreach ($stateSlams as $city => $citySlams) {
                        echo '<li>' . $city . ' (' . count($citySlams) . ')</li>';
                    }
                    echo '</ul></li>';
                }
            ?>
            </ul>
        </div>
        <div class="column column-75">
            <div id="map"></div>
            <div id="osm">
                ©<a href="http://www.openstreetmap.org">OpenStreetMap</a> und <a href="http://www.openstreetmap.org/copyright">Mitwirkende</a>, <a href="http://creativecommons.org/licenses/by-sa/2.0/deed.de">CC-BY-SA</a>
            </div>
        </div>
    </div>

    <script>
      // initialize Leaflet, center to germany
      var map = L.map('map').setView({lon: 10.018343, lat: 51.133481}, 5.5);

      // add the OpenStreetMap tiles
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
      }).addTo(map);

      // show the scale bar on the lower left corner
      L.control.scale().addTo(map);

      // show a marker on the map
      <?php
        foreach ($slams as $slam) {
            if ($slam->longitude && $slam->latitude) {
                echo sprintf(
                    'L.marker({lon: %f, lat: %f}).bindPopup(\'%s\').addTo(map);',
                    $slam->longitude,
                    $slam->latitude,
                    $this->Html->link($slam->title, ['action' => 'view', $slam->slug])
                );
            }
        }
      ?>
    </script>
</div>
