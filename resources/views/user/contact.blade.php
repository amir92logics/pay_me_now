@extends($activeTemplate.'layouts.frontend')

@section('content')

@php
    $contact = getContent('contact_us.content', true);
    $contacts = getContent('contact_us.element');
@endphp
<!-- Banner Section Starts -->
	<section class="banner" id="home">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<!-- Header content start -->
					<div class="header-content wow fadeInUp">
						<h2>{{ __(@$contact->data_values->heading) }}</h2>
						<p>{{ __(@$contact->data_values->sub_heading) }}</p>
						 @foreach($contacts as $singleContact)
                        <br> <span>{{ __($singleContact->data_values->address_type) }}</span>{{ __($singleContact->data_values->address) }}</a>

                         @endforeach
					</div>
					<!-- Header content end -->
				</div>

			</div>
		</div>
	</section>
	<!-- Banner Section Ends -->

<!-- Contact us section starts -->
	<section class="contactus" id="contact">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<!-- Contact us Form start -->
					<div class="contact-form wow fadeInUp" data-wow-delay="0.2s">
						<form class="contact-form" method="post" action="">
                @csrf
              <div class="row">
                <div class="col-lg-6 form-group">
                  <label>@lang('Name')</label>
                  <div class="custom--field">
                    <input name="name" type="text" class="form-control" value="@if(auth()->user()) {{ auth()->user()->fullname }} @else {{ old('name') }} @endif" @if(auth()->user()) readonly @endif required>
                    <i class="las la-user"></i>
                  </div>
                </div><!-- form-group end -->
                <div class="col-lg-6 form-group">
                  <label>@lang('Email')</label>
                  <div class="custom--field">
                    <input name="email" type="email" class="form-control" value="@if(auth()->user()) {{ auth()->user()->email }} @else {{old('email')}} @endif" @if(auth()->user()) readonly @endif required>
                    <i class="las la-envelope"></i>
                  </div>
                </div><!-- form-group end -->
                <div class="col-lg-12 form-group">
                  <label>@lang('Subject')</label>
                  <div class="custom--field">
                    <input name="subject" type="text" class="form-control" value="{{old('subject')}}" required>
                    <i class="las la-sticky-note"></i>
                  </div>
                </div><!-- form-group end -->
                <div class="col-lg-12 form-group">
                  <label>@lang('Message')</label>
                  <div class="custom--field">
                    <textarea name="message" class="form-control">{{old('message')}}</textarea>
                    <i class="las la-sms"></i>
                  </div>
                </div><!-- form-group end -->
                <div class="col-lg-12 form-group">
                  <button type="submit" class="btn btn-primary">@lang('Submit Now')</button>
                </div><!-- form-group end -->
              </div><!-- row end -->
            </form>
					</div>
					<!-- Contact us Form end -->
				</div>
			</div>
		</div>
	</section>
	<!-- Contact us section ends -->

@endsection
