@if ($child->categoryChildrent->count())
<ul class="dropdown-menu multi-level" role="menu">
    @foreach ($child->categoryChildrent as $key => $categoryChildrent)
    <li class="dropdown-submenu">
        <a id="aChild" href="{{ route('home.categoryProduct',['slug'=>$categoryChildrent->slug]) }}">{{ $categoryChildrent->category_name }}
            <i class=" {{ ($categoryChildrent->categoryChildrent->count()) ? 'fa fa-chevron-right' : '' }} iChild"></i>
        </a>
        @if ($categoryChildrent->categoryChildrent->count())
        @include('home.components.childMenu',['child'=>$categoryChildrent])
        @endif
    </li>
    @endforeach
</ul>
@endif