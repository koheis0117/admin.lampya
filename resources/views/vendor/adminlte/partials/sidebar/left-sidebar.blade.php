<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column {{ config('adminlte.classes_sidebar_nav', '') }}" data-widget="treeview" role="menu" data-accordion="true">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link @if ( Route::currentRouteName()=='home')active @endif">
                <i class="nav-icon fas fa-columns"></i>
                <p>
                    ホーム
                </p>
                </a>
            </li>
            <li class="nav-item has-treeview @if ( Route::currentRouteName()=='stock_create' || Route::currentRouteName()=='stock_create' || Route::currentRouteName()=='stock_edit' || Route::currentRouteName()=='stock_list') menu-open @endif">
                <a href="#" class="nav-link @if ( Route::currentRouteName()=='stock_create' || Route::currentRouteName()=='stock_edit' || Route::currentRouteName()=='stock_list') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>在庫管理
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('stock_create') }}" class="nav-link @if ( Route::currentRouteName()=='stock_create' || Route::currentRouteName()=='stock_edit' )active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>在庫操作</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stock_list') }}" class="nav-link @if ( Route::currentRouteName()=='stock_list' )active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>在庫一覧</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('item_list') }}" class="nav-link @if ( Route::currentRouteName()=='item_list' || Route::currentRouteName()=='item_edit' )active @endif">
                <i class="nav-icon fas fa-edit"></i>
                <p>商品管理</p>
                </a>
            </li>
            </ul>
        </nav>
    </div>

</aside>

<script>
$('.treeview-menu li a').click(function(){
	$('.treeview-menu li a').removeClass('active');
	$(this).addClass('active');
});
</script>