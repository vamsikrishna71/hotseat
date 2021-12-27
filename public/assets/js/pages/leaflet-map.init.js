/******/
(function() {
    // webpackBootstrap
    var __webpack_exports__ = {};
    /*!************************************************!*\
      !*** ./resources/js/pages/leaflet-map.init.js ***!
      \************************************************/
    var mymap = L.map("leaflet-map").setView([51.505, -0.09], 2);
    var imgUrl =
        "https://wallpapers.com/images/high/pc-games-backdrop-pieqqvn9v2z6yspx.jpg";
    L.tileLayer(imgUrl, {
        maxZoom: 1,
        attribution: "mapbox/streets-v11",
        nowrap: false,
        zoomOffset: -1,
    }).addTo(mymap);
})();