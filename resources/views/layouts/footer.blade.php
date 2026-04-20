<style>
    /* --- CSS UNTUK FOOTER --- */
    .footer {
        background-color: #1e2535; /* Warna biru gelap sesuai gambar */
        color: #f8fafc;
        padding: 60px 5% 20px; /* Jarak atas 60px, samping 5%, bawah 20px */
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        margin-top: 40px; /* Jarak dari konten di atasnya */
    }

    .footer-container {
        display: grid;
        /* Kolom pertama lebih lebar, 2 kolom lainnya proporsional */
        grid-template-columns: 2fr 1fr 1.5fr; 
        gap: 40px;
        margin-bottom: 40px;
    }

    /* Responsif untuk layar HP: jadikan 1 kolom memanjang ke bawah */
    @media (max-width: 768px) {
        .footer-container {
            grid-template-columns: 1fr;
        }
    }

    .footer-title {
        font-size: 16px;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 20px;
    }

    .footer-text {
        font-size: 13px;
        color: #94a3b8;
        line-height: 1.6;
    }

    /* Style untuk Menu Cepat */
    .footer-links {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        text-decoration: none;
        color: #94a3b8;
        font-size: 13px;
        transition: color 0.2s;
    }

    .footer-links a:hover {
        color: #ffffff;
    }

    /* Style untuk Kontak */
    .footer-contact {
        list-style: none;
        padding: 0;
    }

    .footer-contact li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
        color: #94a3b8;
        font-size: 13px;
        line-height: 1.5;
    }

    .footer-contact svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0; /* Agar ikon tidak mengecil saat teks panjang */
        color: #cbd5e1;
    }

    /* Garis bawah dan Copyright */
    .footer-bottom {
        border-top: 1px solid #334155; /* Garis pemisah tipis */
        padding-top: 24px;
        text-align: center;
    }

    .footer-bottom p {
        font-size: 12px;
        color: #64748b;
    }
</style>

<footer class="footer">
    <div class="footer-container">
        
        <div class="footer-col">
            <h3 class="footer-title">e-Gang</h3>
            <p class="footer-text">
                Sistem Manajemen Pengajuan Surat Magang Politeknik Negeri Cilacap. Memudahkan mahasiswa dalam mengajukan surat pengantar magang industri.
            </p>
        </div>

        <div class="footer-col">
            <h3 class="footer-title">Menu Cepat</h3>
            <ul class="footer-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Profil Saya</a></li>
                <li><a href="#">Pedoman Magang</a></li>
                <li><a href="#">Ajukan Surat</a></li>
                <li><a href="#">Riwayat Surat</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3 class="footer-title">Kontak</h3>
            <ul class="footer-contact">
                <li>
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
                    </svg>
                    <span>Jl. Dr. Soetomo No.1, Sidakaya, Cilacap, Jawa Tengah 53212</span>
                </li>
                <li>
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.864-1.04l-3.218-.46a2.25 2.25 0 00-2.316.924l-1.352 1.352a15.043 15.043 0 01-6.8-6.8l1.352-1.352a2.25 2.25 0 00.924-2.316l-.46-3.218a2.25 2.25 0 00-1.04-.864H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path>
                    </svg>
                    <span>(0282) 537992</span>
                </li>
                <li>
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"></path>
                    </svg>
                    <span>info@pnc.ac.id</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 Politeknik Negeri Cilacap. All rights reserved.</p>
    </div>
</footer>