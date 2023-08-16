@extends($activeTemplate.'layouts.dashboard')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-box content-single">
                <article class="post-180 gd_place type-gd_place status-publish hentry gd_placecategory-hotels">
                    <header>
                        <h1 class="entry-title">{{ $atm->name }}</h1>
                    </header>
                    <div class="entry-content entry-summary">
                        <div id="map-canvas" style="height: 425px; width: 100%; position: relative; overflow: hidden;">
                        </div>
                        @if($atm->latitude && $atm->longitude)
                        @endif
                        <div class="geodir-single-taxonomies-container">
                            <div class="geodir-pos_navigation clearfix">
                                <div class="geodir-post_left">
                                    <a href="{{ url()->previous() }}" rel="prev">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="entry-footer"></footer>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection



@push('script')

@if($atm->latitude && $atm->longitude)
<script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key=<?php echo ($general->google_map_api_key) ?>&libraries=places&region=GB'></script>
<script defer>
    function initialize() {
        var latLng = new google.maps.LatLng(<?php echo ($atm->latitude) ?>, <?php echo ($atm->longitude) ?>);
        var mapOptions = {
            zoom: 14,
            minZoom: 6,
            maxZoom: 17,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT
            },
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            panControl: false,
            mapTypeControl: false,
            scaleControl: false,
            overviewMapControl: false,
            rotateControl: false
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var image = new google.maps.MarkerImage("{{ asset('assets/images/pin.png') }}", null, null, null, new google.maps.Size(40, 52));

        var content = `
            <div class="gd-bubble" style="">
                <div class="gd-bubble-inside">
                    <div class="geodir-bubble_desc">
                    <div class="geodir-bubble_image">
                        <div class="geodir-post-slider">
                            <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="geodir-bubble-meta-side">
                    <div class="geodir-output-location">
                    <div class="geodir-output-location geodir-output-location-mapbubble">
                        <div class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Place Title: </span></span>{{ $atm->name }}</div>
                        <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Address: </span></span><span itemprop="streetAddress">{{ $atm->address }}</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>`;
        var marker = new google.maps.Marker({
            position: latLng,
            icon: image,
            map: map,
            title: '{{ $atm->name }}'
        });
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, 'click', (function(marker) {
            return function() {
                infowindow.setContent(content)
                infowindow.open(map, marker);
            }
        })(marker));
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

@endif

@endpush