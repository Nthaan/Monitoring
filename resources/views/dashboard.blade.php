<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>

    <!-- toast buat notif  -->

    <div class="toast" id="toast">
        <i data-lucide="check-circle"></i>
        <span>Pengajuan berhasil dikirim</span>
    </div>

    <!-- ================= HEADER ================= -->
    <header class="topbar">
        <div class="topbar-left">
            <div class="logo">SC</div>
            <span class="app-name">Smart Campus</span>
        </div>

        <div class="topbar-right" style="display:flex;align-items:center;gap:12px;">
            <!-- THEME TOGGLE (1 CLICK) -->
            <button id="themeToggle" class="theme-toggle" title="Ganti Tema">
                <i data-lucide="moon"></i>
            </button>

            <!-- LOGOUT -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i data-lucide="log-out"></i>
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- ================= CONTENT ================= -->
    <div class="dashboard-layout">

        <!-- LEFT : TABLE -->
        <div class="left-content">
            <div class="card">

                <div class="table-header">
                    <h3>Pengajuan Saya</h3>
                    <div class="table-actions">

                        <!-- SEARCH -->
                        <input
                            type="text"
                            id="searchInput"
                            class="search"
                            placeholder="Cari pengajuan...">

                        <!-- FILTER STATUS -->
                        <div class="filter-wrapper" id="statusDropdown">
                            <i data-lucide="filter"></i>
                            <span id="statusLabel">Semua Status</span>
                            <i data-lucide="chevron-down"></i>

                            <div class="filter-menu">
                                <div data-value="">Semua Status</div>
                                <div data-value="sedang diproses">Sedang Diproses</div>
                                <div data-value="menunggu approval">Menunggu Approval</div>
                                <div data-value="selesai">Selesai</div>
                            </div>
                        </div>


                        <!-- TOMBOL AJUKAN -->
                        <button class="btn-primary" id="openModal">
                            <i data-lucide="plus"></i>
                            Ajukan Layanan
                        </button>

                    </div>

                </div>



                <table class="pengajuan-table">
                    <thead>
                        <tr>
                            <th>Jenis Layanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>PIC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Bimbingan Skripsi</b></td>
                            <td>20 Nov 2025</td>
                            <td>
                                <span class="badge blue">Sedang Diproses</span>
                            </td>
                            <td>Anaxagoras</td>
                        </tr>

                        <tr>
                            <td><b>Surat Keterangan</b></td>
                            <td>18 Nov 2025</td>
                            <td>
                                <span class="badge orange">Menunggu Approval</span>
                            </td>
                            <td>Lygus</td>
                        </tr>

                        <tr>
                            <td><b>Pengajuan Cuti</b></td>
                            <td>15 Nov 2025</td>
                            <td>
                                <span class="badge green">Selesai</span>
                            </td>
                            <td>Phainon</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <!-- RIGHT : SUMMARY -->
        <div class="right-content">
            <div class="summary-card blue">
                <p>Pengajuan Aktif</p>
                <h2>3</h2>
            </div>

            <div class="summary-card green">
                <p>Selesai</p>
                <h2>12</h2>
            </div>

            <div class="summary-card orange">
                <p>Menunggu Review</p>
                <h2>1</h2>
            </div>
        </div>

    </div>

    <footer class="footer">
        <span>Smart Campus</span>
        <span>• built with cinta dan kasih AVV</span>
        <span class="footer-year">© 2025</span>
    </footer>


    <!-- ================= SCRIPT ================= -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        const body = document.body;
        const toggle = document.getElementById('themeToggle');

        // Load saved theme
        if (localStorage.getItem('theme') === 'dark') {
            body.classList.add('dark');
            toggle.innerHTML = '<i data-lucide="sun"></i>';
        }

        lucide.createIcons();

        toggle.addEventListener('click', () => {
            body.classList.toggle('dark');
            const isDark = body.classList.contains('dark');

            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            toggle.innerHTML = `<i data-lucide="${isDark ? 'sun' : 'moon'}"></i>`;
            lucide.createIcons();
        });
    </script>


    <!-- ===== MODAL AJUKAN LAYANAN ===== -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal">

            <h3>
                <i data-lucide="file-plus"></i>
                Ajukan Layanan
            </h3>

            <form id="pengajuanForm">

                <!-- ================= JENIS LAYANAN ================= -->
                <div class="form-group">
                    <label>Jenis Layanan</label>

                    <div class="service-options">

                        <label class="service-card">
                            <input type="radio" name="layanan"
                                value="Bimbingan Skripsi"
                                data-pic="Dosen Pembimbing" required>

                            <div class="service-content">
                                <div class="service-title">
                                    <i data-lucide="book-open"></i>
                                    <span>Bimbingan Skripsi</span>
                                </div>
                                <p>Konsultasi & arahan dosen</p>
                            </div>
                        </label>

                        <label class="service-card">
                            <input type="radio" name="layanan"
                                value="Surat Keterangan Aktif"
                                data-pic="Staff Akademik">

                            <div class="service-content">
                                <div class="service-title">
                                    <i data-lucide="file-text"></i>
                                    <span>Surat Keterangan Aktif</span>
                                </div>
                                <p>Surat aktif, izin, dll</p>
                            </div>
                        </label>

                        <label class="service-card">
                            <input type="radio" name="layanan"
                                value="Pengajuan Cuti"
                                data-pic="Admin Fakultas">

                            <div class="service-content">
                                <div class="service-title">
                                    <i data-lucide="pause-circle"></i>
                                    <span>Pengajuan Cuti</span>
                                </div>
                                <p>Cuti akademik mahasiswa</p>
                            </div>
                        </label>

                        <label class="service-card">
                            <input type="radio" name="layanan"
                                value="Pengajuan Beasiswa"
                                data-pic="Admin Fakultas">

                            <div class="service-content">
                                <div class="service-title">
                                    <i data-lucide="award"></i>
                                    <span>Pengajuan Beasiswa</span>
                                </div>
                                <p>Pengajuan bantuan studi</p>
                            </div>
                        </label>

                    </div>
                </div>

                <!-- ================= PIC ================= -->
                <div class="form-group">
                    <label>PIC (Penanggung Jawab)</label>

                    <div class="pic-options">

                        <label class="pic-card">
                            <input type="radio" name="pic"
                                value="Dosen Pembimbing" required>
                            <div>
                                <b><i data-lucide="user"></i> Dosen</b>
                                <span>Pembimbing</span>
                            </div>
                        </label>

                        <label class="pic-card">
                            <input type="radio" name="pic"
                                value="Staff Akademik">
                            <div>
                                <b><i data-lucide="users"></i> Staff</b>
                                <span>Akademik</span>
                            </div>
                        </label>

                        <label class="pic-card">
                            <input type="radio" name="pic"
                                value="Admin Fakultas">
                            <div>
                                <b><i data-lucide="shield"></i> Admin</b>
                                <span>Fakultas</span>
                            </div>
                        </label>

                    </div>
                </div>

                <!-- ================= ACTION ================= -->
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="closeModal">
                        Batal
                    </button>
                    <button type="submit" class="btn-primary">
                        Kirim Pengajuan
                    </button>
                </div>

            </form>
        </div>
    </div>

    </div>
    <script>
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');
        const modalOverlay = document.getElementById('modalOverlay');
        const form = document.getElementById('pengajuanForm');
        const tableBody = document.querySelector('.pengajuan-table tbody');

        openModal.onclick = () => modalOverlay.classList.add('show');
        closeModal.onclick = () => modalOverlay.classList.remove('show');

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('show');
            }
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const layanan = document.querySelector(
                'input[name="layanan"]:checked'
            ).value;

            const pic = document.querySelector(
                'input[name="pic"]:checked'
            ).value;

            const tanggal = new Date().toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });


            const row = document.createElement('tr');
            row.classList.add('new-row');
            row.innerHTML = `
            <td><b>${layanan}</b></td>
            <td>${tanggal}</td>
            <td><span class="badge orange">Menunggu Approval</span></td>
            <td>${pic}</td>
            
            
            `;

            tableBody.prepend(row);

            modalOverlay.classList.remove('show');
            form.reset();

            const toast = document.getElementById('toast');

            function showToast() {
                toast.classList.add('show');
                lucide.createIcons();

                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }
            showToast();

        });
    </script>

    <script>
        const layananRadios = document.querySelectorAll('input[name="layanan"]');
        const picRadios = document.querySelectorAll('input[name="pic"]');

        layananRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                const targetPic = radio.dataset.pic;

                picRadios.forEach(pic => {
                    if (pic.value === targetPic) {
                        pic.checked = true;
                        pic.closest('.pic-card').classList.remove('disabled');
                    } else {
                        pic.checked = false;
                        pic.closest('.pic-card').classList.add('disabled');
                    }
                });
            });
        });
    </script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        function renderIcons() {
            lucide.createIcons();
        }

        // pertama load
        renderIcons();

        // render ulang pas modal dibuka
        document.getElementById('openModal').addEventListener('click', () => {
            document.getElementById('modalOverlay').classList.add('show');
            setTimeout(renderIcons, 10);
        });

        // render ulang pas toast muncul
        function showToast() {
            const toast = document.getElementById('toast');
            toast.classList.add('show');
            renderIcons();

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    </script>


    <!-- scirpt untuk search  -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const rows = document.querySelectorAll('.pengajuan-table tbody tr');

        function filterTable() {
            const keyword = searchInput.value.toLowerCase();
            const status = statusFilter.value.toLowerCase();

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const statusText = row.querySelector('.badge').innerText.toLowerCase();

                const matchSearch = text.includes(keyword);
                const matchStatus = status === "" || statusText === status;

                row.style.display = (matchSearch && matchStatus) ? "" : "none";
            });
        }

        searchInput.addEventListener('input', filterTable);
        statusFilter.addEventListener('change', filterTable);
    </script>

</body>

</html>

