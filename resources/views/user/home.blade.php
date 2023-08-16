@extends($activeTemplate.'layouts.frontend')
@section('content')


    @include($activeTemplate. 'partials.banner')

    @include($activeTemplate. 'sections.about')
    @include($activeTemplate. 'sections.howToWork')
    @include($activeTemplate. 'sections.feature')
    @include($activeTemplate. 'sections.testimonial')
    @include($activeTemplate. 'sections.overView')
    @include($activeTemplate. 'sections.faq')

@endsection
