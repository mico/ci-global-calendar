
{{-- 
    Footer menu
    
    PARAMETERS:
        - $container: boolean - show the menu in a container or not 
        - $padding-x: string - the padding on the left and right side of the nav bar, expressed in bootstrap spacing notation eg. px-5
        - $backgroundColor: string - the footer background (eg.#B5A575)
        - $stickyFooter: boolean - footer sticky or not
        - $items: array - the items tree to render (in the footer just the first level is rendered, no dropdown available since bootsrap allow just one main nav)
--}}


@section('javascript-document-ready')
    @parent
    {{-- Add some margin below the body to compensate the sticky footer --}}
    @if($stickyFooter)
        $('body').css('margin-bottom', '6rem');
    @endif

@stop

{{--<hr class="mt-5">--}}
<footer class="{{$paddingX}} @if($stickyFooter) sticky @endif " style="background-color: {{$backgroundColor}}">
    @if($container)<div class="container">@endif
        <nav class="row">
            {{--<div class="col-12 mb-2 mb-sm-0">
                <div class="text text-white pt-2 pb-0 pb-md-2">© 2019, made with <i class="fas fa-heart"></i> by Round Robin Team</div>
            </div>--}}
            
            <div class="col-6 mb-2 mb-sm-0">
                <div class="text text-white pt-2 pb-0 pb-md-2">© 2019, made with <i class="fas fa-heart"></i> by Round Robin Team</div>
            </div>
            <div class="col-6 col-sm-5 col-sm-push-5 text-center text-md-right pr-0">
                
                <ul class="footerMenu m-0 p-0">
                    @include('laravel-quick-menus::menus.nav.nav-items', ['items' => $items])
                </ul>
            </div>
            
            
            {{--
            <div class="col-12 col-sm-6 col-sm-pull-6 text-center text-md-left mb-2 mb-sm-0">
                <div class="text text-white pt-2 pb-0 pb-md-2">© 2019, made with <i class="fas fa-heart"></i> by Round Robin Team</div>
            </div>
            <div class="col-12 col-sm-5 col-sm-push-5 text-center text-md-right pr-0">
                <ul class="footerMenu m-0 p-0">
                    @include('menus.nav.nav-items', ['items' => $items])
                </ul>
            </div>
            <div class="col-12 col-sm-1 col-sm-push-1 text-center text-md-right d-none d-md-block">
                @include('partials.language-selector')
            </div>
            --}}
        </nav>
    @if($container)</div>@endif
</footer>
