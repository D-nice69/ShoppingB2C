@if ($p->categoryPostChildrent->count())
    <ul class="dropdown-menu multi-level" role="menu">
        @foreach ($p->categoryPostChildrent as $key => $categoryPostChildrent)
            <li class="dropdown-submenu">
                <a id="aChild" href="{{ route('home.newCategory',['slug'=>$categoryPostChildrent->slug]) }}">{{ $categoryPostChildrent->name }}
                    <i class=" {{ ($categoryPostChildrent->categoryPostChildrent->count()) ? 'fa fa-chevron-right' : '' }} iChild"></i>
                </a>
                @if ($categoryPostChildrent->categoryPostChildrent->count())
                    @include('home.components.childNew',['p'=>$categoryPostChildrent])
                @endif
            </li>
        @endforeach
    </ul>
@endif
