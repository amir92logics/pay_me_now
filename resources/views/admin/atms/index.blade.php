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
<div class="row" id="basic-datatable">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$pageTitle}}</h4>
                <button data-bs-toggle="modal" href="#addAtmModal" class="float-right btn btn-sm btn-success">@lang('Add New ATM')</button>
            </div>
            <div class="card-body">
                <p class="card-text">
                    @lang('Atm Locations').
                </p>
            </div>
            <div class="table-responsive">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Address')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($atms as $atm)
                        <tr>
                            <td data-label="#@lang('Name')">{{$atm->name}}<br>
                            </td>
                            <td data-label="@lang('Address')" class="text-primary">
                                <strong>{{$atm->address}}</strong>
                            </td>
                            <td data-label="@lang('Status')">
                                @if($atm->status == 1)
                                <span class="badge rounded-pill badge-light-primary me-1">@lang('Active')</span>
                                @elseif($atm->status == 0)
                                <span class="badge rounded-pill badge-light-secondary me-1">@lang('Inactive')</span>
                                @endif
                            </td>
                            <td data-label="@lang('Action')">
                                <a class="btn btn-sm btn-info" href="{{ route('admin.atms.edit',$atm->id) }}">Edit</a>
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.atms.show',$atm->id) }}">View Map</a>
                                <form action="{{ route('admin.atms.destroy', $atm->id) }}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
{{-- Add Sub Balance MODAL --}}
<div id="addAtmModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('New ATM Location')</h5>

            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name">@lang('Name')</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="address-input">@lang('Address')</label>
                            <input type="text" id="address-input" name="address" class="form-control map-input">
                            <input type="hidden" name="latitude" id="address-latitude" class="form-control" value="0" />
                            <input type="hidden" name="longitude" id="address-longitude" class="form-control" value="0" />
                        </div>
                        <div id="address-map-container" style="width:100%;height:300px; ">
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-success">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
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