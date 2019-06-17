
     <!-- Authentication Links -->
     @if(\Auth::check() && \Auth::user()->authorizeRoles(['admin']) && Request::is('admin/*') )
        @include('layouts.admin')
     @else
        @include('layouts.user')
     @endif

