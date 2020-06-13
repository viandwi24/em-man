@php
$menus = [
    [ 'type' => 'item', 'text' => 'Dashboard', 'icon' => 'fas fa-home', 'url' => url()->route('admin.home') ],

    [ 'type' => 'treeview', 'text' => 'Manajemen', 'icon' => 'fas fa-tasks', 'item' => [
        [ 'type' => 'item', 'text' => 'Unit', 'icon' => 'fas fa-building', 'url' => url()->route('admin.unit.index') ],
        [ 'type' => 'item', 'text' => 'Outsourcing', 'icon' => 'fas fa-synagogue', 'url' => url()->route('admin.outsourcing.index') ],
        [ 'type' => 'item', 'text' => 'Bagian', 'icon' => 'fas fa-briefcase', 'url' => url()->route('admin.bagian.index') ],
        [ 'type' => 'item', 'text' => 'Jabatan', 'icon' => 'fas fa-id-badge', 'url' => url()->route('admin.jabatan.index') ],
        [ 'type' => 'item', 'text' => 'Karyawan', 'icon' => 'fas fa-user-tie', 'url' => url()->route('admin.karyawan.index') ],
    ]],

    [ 'type' => 'treeview', 'text' => 'Karyawan', 'icon' => 'fas fa-user-tie', 'item' => [
        [ 'type' => 'item', 'text' => 'Mutasi', 'icon' => 'fas fa-paper-plane', 'url' => url()->route('admin.mutasi.index') ],
        [ 'type' => 'item', 'text' => 'Cuti', 'icon' => 'fas fa-hourglass-half', 'url' => url()->route('admin.cuti.index') ],
        [ 'type' => 'item', 'text' => 'Surat Peringatan', 'icon' => 'fas fa-scroll', 'url' => url()->route('admin.peringatan.index') ],
    ]],
    
    [ 'type' => 'treeview', 'text' => 'Perusahaan', 'icon' => 'fas fa-building', 'item' => [
        [ 'type' => 'item', 'text' => 'Rencana Kerja', 'icon' => 'fas fa-list-alt', 'url' => url()->route('admin.rencana.index') ],
    ]],

    [ 'type' => 'treeview', 'text' => 'Laporan', 'icon' => 'fas fa-chart-line', 'item' => [
        [ 'type' => 'item', 'text' => 'Laporan Karyawan', 'icon' => 'fas fa-chart-line', 'url' => url()->route('admin.laporan') ],
    ]],

    [ 'type' => 'item', 'text' => 'Pelatihan', 'icon' => 'fas fa-graduation-cap', 'url' => url()->route('admin.periode.index') ],
]
@endphp
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url()->route('admin.home') }}">
                Em-Man
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url()->route('admin.home') }}">eM</a>
        </div>
        <ul class="sidebar-menu">
            @foreach ($menus as $item)
                @if ($item['type'] == 'item')
                    <li class="{{ url()->current() == $item['url'] ? ' active' : '' }}">
                        <a class="nav-link" href="{{ $item['url'] }}">
                            <i class="{{ $item['icon'] }}"></i> <span>{{ $item['text'] }}</span>
                        </a>
                    </li>
                @elseif ($item['type'] == 'treeview')
                    @php $active = ''; @endphp
                    @for ($i = 0; $i < count($item['item']); $i++)
                        @php 
                        if (url()->current() == $item['item'][$i]['url'] ? ' active' : '')
                        {
                            $active = ' active';
                            break;
                        }
                        @endphp
                    @endfor
                    <li class="dropdown{{ $active }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                            <i class="{{ @$item['icon'] }}"></i> <span>{{ $item['text'] }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($item['item'] as $subitem)
                            <li class="{{ url()->current() == $subitem['url'] ? ' active' : '' }}">
                                <a class="nav-link" href="{{ $subitem['url'] }}">
                                    <span>{{ $subitem['text'] }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                @elseif ($item['type'] == 'header')
                    <li class="menu-header">{{ $item['text'] }}</li>
                @endif
            @endforeach
        </ul>
    </aside>
</div>