@extends('admin.layouts.app')
@section('panel')
@push('style')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/plugins/forms/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/plugins/forms/form-wizard.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/forms/wizard/bs-stepper.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/forms/select/select2.min.css')}}">
<!-- END: Page CSS-->
@endpush

<!-- Deposit Wizard -->
<form action="{{route('admin.atms.update', $atm->id)}}" method="post">
    @method('PATCH')
    @csrf
    <section class="horizontal-wizard">
        <div class="bs-stepper horizontal-wizard-example">
            <div class="bs-stepper-content">
                <div id="account-details" class="" role="tabpanel" aria-labelledby="account-details-trigger">
                    <div class="content-header mb-1">
                        <h5 class="">{{$pageTitle}}</h5>
                        <!-- <small class="text-muted"></small> -->
                    </div>
                    <div class="row">
                        <div class="form-group mb-1 col-md-9 col-6">
                            <label class="form-label" for="name">ATM Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $atm->name }}" placeholder="ATM Name" />
                        </div>
                        <div class="form-group mb-1 col-md-3 col-6">
                            <label class="form-label" for="status">ATM Status</label>
                            <div class="form-check form-switch form-check-primary mb-1 col-md-6">
                                <input type="checkbox" class="form-check-input" name="status" id="status" @if ($atm->status)
                                {{ "checked" }}
                                @endif />
                                <label class="form-check-label" for="status">
                                    <span class="switch-icon-left"></span>
                                    <span class="switch-icon-right"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-1 col-md-12">
                            <label class="form-label" for="address-input">Transfer Address</label>
                            <input type="text" name="address" id="address-input" class="form-control map-input" value="{{ $atm->address }}" placeholder="ATM's Address" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-1 col-md-6">
                            <label class="form-label" for="address-latitude">Latitude</label>
                            <input type="text" name="latitude" id="address-latitude" class="form-control" value="{{ $atm->latitude }}" placeholder="ATM's latitude" />
                        </div>
                        <div class="form-group mb-1 col-md-6">
                            <label class="form-label" for="address-longitude">Longitude</label>
                            <input type="text" name="longitude" id="address-longitude" class="form-control" value="{{ $atm->longitude }}" placeholder="ATM's longitude" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn--primary text-white btn-next">
                            <span class="align-middle d-sm-inline-block d-none">Update</span>
                            <!-- <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i> -->
                        </button>
                    </div>
                    <div id="address-map-container" style="width:100%;height:300px; ">
                        <div style="width: 100%; height: 100%" id="address-map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<!-- /Deposit Wizard -->

@endsection



@push('script')
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/forms/form-wizard.min.js')}}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ $general->google_map_api_key }}&libraries=places&callback=initialize" async defer></script>

<script>
    function initialize() {

        $('form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
        const locationInputs = document.getElementsByClassName("map-input");
        const autocompletes = [];
        const geocoder = new google.maps.Geocoder;
        for (let i = 0; i < locationInputs.length; i++) {

            const input = locationInputs[i];
            const fieldKey = input.id.replace("-input", "");
            const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

            const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
            const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

            const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 13
            });
            const marker = new google.maps.Marker({
                map: map,
                position: {
                    lat: latitude,
                    lng: longitude
                },
            });

            marker.setVisible(isEdit);

            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.key = fieldKey;
            autocompletes.push({
                input: input,
                map: map,
                marker: marker,
                autocomplete: autocomplete
            });
        }

        for (let i = 0; i < autocompletes.length; i++) {
            const input = autocompletes[i].input;
            const autocomplete = autocompletes[i].autocomplete;
            const map = autocompletes[i].map;
            const marker = autocompletes[i].marker;

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                marker.setVisible(false);
                const place = autocomplete.getPlace();

                geocoder.geocode({
                    'placeId': place.place_id
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        const lat = results[0].geometry.location.lat();
                        const lng = results[0].geometry.location.lng();
                        setLocationCoordinates(autocomplete.key, lat, lng);
                    }
                });

                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    input.value = "";
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

            });
        }
    }

    function setLocationCoordinates(key, lat, lng) {
        const latitudeField = document.getElementById(key + "-" + "latitude");
        const longitudeField = document.getElementById(key + "-" + "longitude");
        latitudeField.value = lat;
        longitudeField.value = lng;
    }
</script>
@endpush