@inject('menuItemHelper', '\JeroenNoten\LaravelAdminLte\Helpers\MenuItemHelper')
@if (isset($item['role']) && \App\Lib\Myhelper::hasAccess($item['role'], session('roles')))

    @if ($menuItemHelper->isHeader($item))

        {{-- Header --}}
        @include('adminlte::partials.sidebar.menu-item-header')

    @elseif ($menuItemHelper->isLegacySearch($item))

        {{-- Search form --}}
        @include('adminlte::partials.sidebar.menu-item-search-form')

    @elseif ($menuItemHelper->isSubmenu($item))

        {{-- Treeview menu --}}
        @include('adminlte::partials.sidebar.menu-item-treeview-menu')

    @elseif ($menuItemHelper->isLink($item))
        
        {{-- Link --}}
            @include('adminlte::partials.sidebar.menu-item-link')

    @endif
    
@endif