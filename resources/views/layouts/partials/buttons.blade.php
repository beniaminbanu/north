@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/buttons.css') }}">
@endpush
@if ($type == 'button')
<a class="{{$class}}" href="{{$link}}" title="{{$title}}">{{$text}}</a>
@elseif ($type = 'click')
    <a class="{{$class}}" href="{{$link}}" title="{{$title}}">{{$text}}</a>
@endif

