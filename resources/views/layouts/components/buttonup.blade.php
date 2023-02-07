@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/buttonup.css') }}">
@endpush
<a href="#header" title="up">
    <div class="buttonUp d-lg-none" id="buttonup">
        <svg>
            <use xlink:href="#arrow">
        </svg>
    </div>
</a>
@push('scripts')
    <script src="{{ asset('js/pages/header.js') }}"></script>
@endpush
