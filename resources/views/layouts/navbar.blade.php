<style>
    .navbar {
        position: sticky;
        top: 0;
        background-color: #1e293b; /* Warna dark blue/slate persis seperti desain */
        width: 100%;
        height: 70px;
        padding: 0 5%; 
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        z-index: 100;
        font-family: 'Inter', sans-serif;
    }

    /* Kiri: Logo */
    .logo-container {
        flex: 1;
        display: flex;
        justify-content: flex-start;
    }

    .logo-img {
        height: 40px;
        width: auto;
    }

    /* Tengah: Menu Links */
    .nav-links {
        flex: 2; /* Mengambil ruang lebih banyak di tengah */
        display: flex;
        justify-content: center;
        list-style: none;
        gap: 32px; /* Jarak antar menu dilebarkan sedikit */
        margin: 0;
        padding: 0;
    }

    .nav-links li a {
        text-decoration: none;
        color: #94a3b8; /* Warna abu-abu redup untuk menu tidak aktif */
        font-size: 14px;
        transition: color 0.2s ease;
        font-weight: 500;
    }

    .nav-links li a:hover, 
    .nav-links li a.active {
        color: #ffffff; /* Berubah putih terang saat aktif/dihover */
    }

    /* Kanan: Profil */
    .profile-section {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        position: relative;
    }

    .profile-btn {
        background: none;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 0;
    }

    .avatar-placeholder {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #d97706; /* Warna oranye kecoklatan seperti di gambar */
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .chevron-icon {
        width: 16px;
        height: 16px;
        color: #94a3b8;
        transition: transform 0.3s ease;
    }

    .profile-section:hover .chevron-icon {
        transform: rotate(180deg);
        color: #ffffff;
    }

    /* Dropdown Menu */
    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 15px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
        min-width: 200px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        visibility: hidden;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
    }

    .profile-section:hover .dropdown-menu {
        visibility: visible;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-menu a, 
    .dropdown-item {
        text-decoration: none;
        color: #334155;
        padding: 12px 16px;
        font-size: 14px;
        transition: background 0.2s;
        display: block;
        width: 100%;
        text-align: left;
        cursor: pointer;
        border: none;
        background: none;
    }

    .dropdown-menu a:hover {
        background-color: #f8fafc;
    }
</style>

<nav class="navbar">
    <div class="logo-container">
        <a href="/">
            <img src="{{ asset('img/logopnc.png') }}" alt="Logo PNC" class="logo-img">
        </a>
    </div>

    <ul class="nav-links">
        <li><a href="/home" class="{{ request()->is('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="/pedoman" class="{{ request()->is('pedoman*') ? 'active' : '' }}">Pedoman Magang</a></li>
        <li><a href="/ajukan" class="{{ request()->is('ajukan*') ? 'active' : '' }}">Ajukan Surat</a></li>
        <li><a href="/riwayat" class="{{ request()->is('riwayat*') ? 'active' : '' }}">Riwayat Surat</a></li>
    </ul>

    <div class="profile-section">
        @auth
            <button class="profile-btn">
                <div class="avatar-placeholder">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <svg class="chevron-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="dropdown-menu">
                <div class="p-4 border-b border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-0.5">Mahasiswa</p>
                    <p class="font-bold text-gray-800 truncate text-sm">{{ Auth::user()->name }}</p>
                </div>
                <a href="/profile">Profil Anda</a>
                <hr class="border-gray-50 m-0">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="dropdown-item text-red-500 hover:bg-red-50 font-semibold w-full text-left">
                        Sign Out
                    </button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded-lg transition duration-200" style="text-decoration: none;">
                Login
            </a>
        @endauth
    </div>
</nav>