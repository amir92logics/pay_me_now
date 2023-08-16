@extends($activeTemplate.'layouts.dashboard')
@section('content')
 <!-- change password -->
   <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
               <div
              class=""
              id="account-vertical-password"
              role="tabpanel"
              aria-labelledby="account-pill-password"
              aria-expanded="false"
            >
              <!-- form -->
              <form action="" method="post" class="register">
                @csrf
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="mb-1">
                      <label class="form-label" for="account-old-password">Old Password</label>
                      <div class="input-group form-password-toggle input-group-merge">
                        <input id="password" type="password" placeholder="Old Password" class="form-control" name="current_password" required autocomplete="current-password">
                        <div class="input-group-text cursor-pointer bg-info">
                          <i data-feather="eye"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="mb-1">
                      <label class="form-label" for="account-new-password">New Password</label>
                      <div class="input-group form-password-toggle input-group-merge">
                        <input id="new_password" type="password" placeholder="New Password" class="form-control" name="password" required autocomplete="current-password">
                        <div class="input-group-text cursor-pointer bg-info">
                          <i data-feather="eye"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-12">
                    <div class="mb-1">
                      <label class="form-label" for="account-retype-new-password">Retype New Password</label>
                      <div class="input-group form-password-toggle input-group-merge">
                         <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="current-password">

                        <div class="input-group-text cursor-pointer bg-info"><i data-feather="eye"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn text-white btn--primary me-1 mt-1">Save changes</button>
                  </div>
                </div>
              </form>
              <!--/ form -->
            </div>
            <!--/ change password -->
@endsection


