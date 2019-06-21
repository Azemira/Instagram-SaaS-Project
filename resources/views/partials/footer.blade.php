<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
                <div class="dropup">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $active_language['native'] }}
                        </button>
                        <div class="dropdown-menu">
                            @foreach($languages as $code => $language)
                                <a href="{{ route('localize', $code) }}" rel="alternate" hreflang="{{ $code }}" class="dropdown-item">{{ $language['native'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                &copy; {{ date('Y') }} <a href="{{ config('app.url') }}" target="_blank">{{ __(config('app.name')) }}</a> &mdash; {{ __(config('pilot.SITE_DESCRIPTION')) }}
            </div>
        </div>
    </div>
</footer>