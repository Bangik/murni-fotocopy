<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{Str::contains(Request::fullUrl(), 'index') ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="{{Str::contains(Request::fullUrl(), 'index') ? 'active' : ''}}"><a class="nav-link" href="{{route('home')}}">Ecommerce Dashboard</a></li>
                </ul>
            </li>
            <li class="menu-header">Data Produk</li>
            <li class="nav-item dropdown {{Str::contains(Request::fullUrl(), 'categories') ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Kategori</span></a>
                <ul class="dropdown-menu">
                    <li class="{{Str::contains(Request::fullUrl(), 'categories/list') ? 'active' : ''}}"><a class="nav-link" href="{{route('categories.index')}}">List Kategori</a></li>
                    <li class="{{Str::contains(Request::fullUrl(), 'categories/create') ? 'active' : ''}}"><a class="nav-link" href="{{route('categories.create')}}">Tambah Kategori</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{Str::contains(Request::fullUrl(), 'brands') ? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Merek</span></a>
                <ul class="dropdown-menu">
                    <li class="{{Str::contains(Request::fullUrl(), 'brands/list') ? 'active' : ''}}"><a class="nav-link" href="{{route('brands.index')}}">List Merek</a></li>
                    <li class="{{Str::contains(Request::fullUrl(), 'brands/create') ? 'active' : ''}}"><a class="nav-link" href="{{route('brands.create')}}">Tambah Merek</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>