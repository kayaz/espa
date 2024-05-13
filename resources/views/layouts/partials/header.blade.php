<div class="header-holder position-fixed">
    <header>
        <div id="header">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-3">
                        <div id="logo">
                            <a href="/{{ $current_locale }}">
                                <img src="{{asset('images/logo.svg') }}" alt="{{ settings()->get("page_title") }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-9">
                        <nav>
                            <ul id="mainmenu" class="mb-0 list-unstyled">
                                <li><a href="{{ route('about.index') }}">@lang('cms.kimjestesmy-menu')</a></li>
                                <li><a href="{{ route('offer.index') }}">@lang('cms.corobimy-menu')</a></li>
                                <li><a href="{{ route('mission.index') }}">@lang('cms.naszawizja-menu')</a></li>
                                <li><a href="{{ route('contact.index') }}">@lang('cms.kontakt-menu')</a></li>
                            </ul>
                            <ul id="lang" class="mb-0 list-unstyled">
                                @foreach($available_locales as $available_locale => $locale_name)
                                    <li @if($available_locale === $current_locale) class="active" @endif>
                                        <a href="{{ changeLocaleUrl(Route::current(), $available_locale) }}">{{ $available_locale }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
