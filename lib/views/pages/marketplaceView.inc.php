<?php ob_start(); ?>

<?php /* Include custom head scripts here... */ ?>
<?php $page->custom_head_scripts = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom CSS here... */ ?>
<?php $page->custom_css = ob_get_contents(); ob_clean(); ?>

<?php /* Include body contents here... */ ?>
<div class="content inline-fix">
    <div class="section">
        <div class="content-header">
            Welcome to the Marketplace!
        </div>

        <div class="width-1" id="map">
        </div>
    </div>

    <div class="section-no-padding">
        <div class="content-header">
            Nearby printers
        </div>
        <div class="cards-content-scroll inline-fix">
            <div class="width-tiny-10-12 width-small-7-12 width-medium-5-12 width-large-3-12 card-wrapper">
                <div class="user-content">
                    <div class="user-profile-pic-wrapper width-1">
                        <div class="user-profile-pic-bg width-1">
                            <img src="/img/temp/001.jpg" />
                        </div>
                        <div class="user-profile-pic-icon">
                            <img src="/img/temp/001.jpg" />
                        </div>
                    </div>
                    <div class="user-info">
                        <h3>Popular near you</h3>
                        <h1>Jamie Gregory</h1>
                        <button class="chat-button button pill"></button>
                    </div>
                </div>
            </div>

            <div class="width-tiny-10-12 width-small-7-12 width-medium-5-12 width-large-3-12 card-wrapper">
                <div class="user-content">
                    <div class="user-profile-pic-wrapper width-1">
                        <div class="user-profile-pic-bg width-1">
                            <img src="/img/temp/001.jpg" />
                        </div>
                        <div class="user-profile-pic-icon">
                            <img src="/img/temp/001.jpg" />
                        </div>
                    </div>
                    <div class="user-info">
                        <h3>Popular near you</h3>
                        <h1>Jamie Gregory</h1>
                        <button class="chat-button button pill"></button>
                    </div>
                </div>
            </div>
            <div class="width-tiny-10-12 width-small-7-12 width-medium-5-12 width-large-3-12 card-wrapper">
                <div class="user-content">
                    <div class="user-profile-pic-wrapper width-1">
                        <div class="user-profile-pic-bg width-1">
                            <img src="/img/temp/001.jpg" />
                        </div>
                        <div class="user-profile-pic-icon">
                            <img src="/img/temp/001.jpg" />
                        </div>
                    </div>
                    <div class="user-info">
                        <h3>Popular near you</h3>
                        <h1>Jamie Gregory</h1>
                        <button class="chat-button button pill"></button>
                    </div>
                </div>
            </div>
            <div class="width-tiny-10-12 width-small-7-12 width-medium-5-12 width-large-3-12 card-wrapper">
                <div class="user-content">
                    <div class="user-profile-pic-wrapper width-1">
                        <div class="user-profile-pic-bg width-1">
                            <img src="/img/temp/001.jpg" />
                        </div>
                        <div class="user-profile-pic-icon">
                            <img src="/img/temp/001.jpg" />
                        </div>
                    </div>
                    <div class="user-info">
                        <h3>Popular near you</h3>
                        <h1>Jamie Gregory</h1>
                        <button class="chat-button button pill"></button>
                    </div>
                </div>
            </div>
            <div class="width-tiny-10-12 width-small-7-12 width-medium-5-12 width-large-3-12 card-wrapper">
                <div class="user-content">
                    <div class="user-profile-pic-wrapper width-1">
                        <div class="user-profile-pic-bg width-1">
                            <img src="/img/temp/001.jpg" />
                        </div>
                        <div class="user-profile-pic-icon">
                            <img src="/img/temp/001.jpg" />
                        </div>
                    </div>
                    <div class="user-info">
                        <h3>Popular near you</h3>
                        <h1>Jamie Gregory</h1>
                        <button class="chat-button button pill"></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $page->content = ob_get_contents(); ob_clean(); ?>

<?php /* Include custom body scripts here... */ ?>
    <script>
        function initMap() {
            var mapDiv = document.getElementById('map');
            var map = new google.maps.Map(mapDiv, {
                center: {lat: 54.6, lng: -4.3},
                zoom: 5,
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_TOP
                },
                scaleControl: false,
                streetViewControl: false,
                mapTypeControl: false
            });

            // Style the map
            map.set('styles', [{"featureType":"all","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"all","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#ffdfc0"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#000000"},{"visibility":"on"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#000000"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#000000"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#dddddd"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#000000"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"visibility":"on"}]}]);

            // Prevent panning and double click zoom if the device is a touch screen
            if(isTouchDevice) {
                map.set('draggable', false);
                map.set('disableDoubleClickZoom', true);
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
<?php $page->custom_body_scripts = ob_get_contents(); ob_end_clean(); ?>
