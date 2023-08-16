@extends($activeTemplate.'layouts.dashboard')
@section('content')
  <!-- account setting page -->
<section id="page-account-settings">
  <div class="row">

    <!-- right content section -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="tab-content">
            <!-- general tab -->
            <div
              role="tabpanel"
              class="tab-pane active"
              id="account-vertical-general"
              aria-labelledby="account-pill-general"
              aria-expanded="true"
            >
              <!-- header section -->
              <div class="d-flex">
                <a href="page-account-settings.html#" class="me-25">
                  <img
                    src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}"
                    id="account-upload-img"
                    class="rounded me-50"
                    alt="profile image"
                    height="80"
                    width="80"
                  />
                </a>
                <!-- upload and reset button -->
                <div class="mt-75 ms-1">
                  <label for="account-upload" class="btn btn-sm text-white btn--primary mb-75 me-75">Upload</label>

                  <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                </div>
                <!--/ upload and reset button -->
              </div>
              <!--/ header section -->

              <!-- form -->
              <form class="validate-form mt-2" action="" method="post" enctype="multipart/form-data">
              @csrf
              <input type="file" id="account-upload" hidden name="image" accept="image/*" accept="image/*" />
                <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="InputFirstname" class="col-form-label">@lang('First Name'):</label>
                                    <input type="text" class="form-control" id="InputFirstname" name="firstname" placeholder="@lang('First Name')" value="{{$user->firstname}}" minlength="3">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="lastname" class="col-form-label">@lang('Last Name'):</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="@lang('Last Name')" value="{{$user->lastname}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="email" class="col-form-label">@lang('E-mail Address'):</label>
                                    <input class="form-control" id="email" placeholder="@lang('E-mail Address')" value="{{$user->email}}" disabled>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="phone" class="col-form-label">@lang('Mobile Number')</label>
                                    <input class="form-control" id="phone" value="{{$user->mobile}}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="address" class="col-form-label">@lang('Address'):</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="@lang('Address')" value="{{@$user->address->address}}" required="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="state" class="col-form-label">@lang('State'):</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="@lang('state')" value="{{@$user->address->state}}" required="">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="zip" class="col-form-label">@lang('Zip Code'):</label>
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="@lang('Zip Code')" value="{{@$user->address->zip}}" required="">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="city" class="col-form-label">@lang('City'):</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="@lang('City')" value="{{@$user->address->city}}" required="">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="col-form-label">@lang('Country'):</label>
                                    <input class="form-control" value="{{@$user->address->country}}" disabled>
                                </div>


                  <div class="col-12">
                    <button type="submit" class="btn btn--primary text-white mt-2 me-1">Save changes</button>
                  </div>
                </div>
              </form>
              <!--/ form -->
            </div>
            <!--/ general tab -->


          </div>
        </div>
      </div>
    </div>
    <!--/ right content section -->
  </div>
</section>
<!-- / account setting page -->
@endsection


@push('script')
 <script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/pages/page-account-settings.min.js')}}"></script>

@endpush
