<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>


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
            <button id="themeToggle" class="theme-toggle" title="Ganti Tema">
                <i data-lucide="moon"></i>
            </button>

            <!-- LOGOUT -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn" id="logoutBtn">
                    <i data-lucide="log-out"></i>
                    Logout
                </button>

            </form>
        </div>
    </header>

    <div class="dashboard-layout">

        <!-- LEFT : TABLE -->
        <div class="left-content">
            <div class="card">

                <div class="table-header">
                    <h3>Pengajuan Saya</h3>
                    <div class="table-actions">

                        <input
                            type="text"
                            id="searchInput"
                            class="search"
                            placeholder="Cari pengajuan...">

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

                        <button class="btn-primary role-only role-mahasiswa" id="openModal">
                            <i data-lucide="plus"></i>
                            Ajukan Layanan
                        </button>


                    </div>

                </div>


                <div class="card role-only role-mahasiswa role-dosen">

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
                                <td class="status-cell role-only role-dosen">
                                    <button class="badge blue status-btn">
                                        Sedang Diproses
                                    </button>

                                </td>

                                <td>Anaxagoras</td>
                            </tr>

                            <tr>
                                <td><b>Surat Keterangan</b></td>
                                <td>18 Nov 2025</td>
                                <td class="status-cell role-only role-dosen">
                                    <button class="badge orange status-btn">
                                        Menunggu Approval
                                    </button>
                                </td>


                                <td>Lygus</td>
                            </tr>

                            <tr>
                                <td><b>Pengajuan Cuti</b></td>
                                <td>15 Nov 2025</td>
                                <td class="status-cell role-only role-dosen">
                                    <button class="badge green status-btn">
                                        Selesai
                                    </button>
                                </td>
                                <td>Phainon</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

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

            <div class="summary-card red role-only role-admin">
                <p>Total Pengajuan</p>
                <h2>120</h2>
            </div>

            <div class="summary-card red role-only role-dosen">
                <p>Perlu Review</p>
                <h2>4</h2>
            </div>

        </div>

    </div>

    <div class="modal-overlay" id="statusModal">
        <div class="modal small">

            <h3>Ubah Status Pengajuan</h3>

            <div class="status-actions">
                <button class="badge blue" data-status="sedang diproses">
                    Sedang Diproses
                </button>
                <button class="badge orange" data-status="menunggu approval">
                    Menunggu Approval
                </button>
                <button class="badge green" data-status="selesai">
                    Selesai
                </button>
            </div>

            <div class="modal-actions">
                <button class="btn-secondary" id="closeStatusModal">
                    Batal
                </button>
            </div>

        </div>
    </div>


    <footer class="footer">
        <span>Smart Campus</span>
        <span>• built with cinta dan kasih AVV</span>
        <span class="footer-year">© 2025</span>
    </footer>

    <!-- SCRIPT -->
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


    <!--  MODAL AJUKAN LAYANAN -->
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

                <!--  PIC  -->
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

                <!--  ACTION  -->
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

    <script>
        function renderIcons() {
            lucide.createIcons();
        }

        renderIcons();

        document.getElementById('openModal').addEventListener('click', () => {
            document.getElementById('modalOverlay').classList.add('show');
            setTimeout(renderIcons, 10);
        });

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
        //dropdown 
        const dropdown = document.getElementById('statusDropdown');
        const label = document.getElementById('statusLabel');
        const items = dropdown.querySelectorAll('.filter-menu div');

        let selectedStatus = "";

        dropdown.addEventListener('click', () => {
            dropdown.classList.toggle('show');
        });
        items.forEach(item => {
            item.addEventListener('click', (e) => {
                e.stopPropagation();

                selectedStatus = item.dataset.value;
                label.innerText = item.innerText;

                dropdown.classList.remove('show');
                filterTable();
            });
        });

        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });
    </script>

    <script>
        const searchInput = document.getElementById('searchInput');

        function filterTable() {
            const keyword = searchInput.value.toLowerCase();

            document.querySelectorAll('.pengajuan-table tbody tr').forEach(row => {
                const text = row.innerText.toLowerCase();
                const statusText = row.querySelector('.badge').innerText.toLowerCase();

                const matchSearch = text.includes(keyword);
                const matchStatus =
                    selectedStatus === "" || statusText === selectedStatus;

                row.style.display = (matchSearch && matchStatus) ? "" : "none";
            });
        }

        searchInput.addEventListener('input', filterTable);
    </script>

<script>
    const statusModal = document.getElementById('statusModal');
    const closeStatusModal = document.getElementById('closeStatusModal');

    let activeBadge = null;

    // buka modal
    document.querySelectorAll('.status-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            activeBadge = btn;
            statusModal.classList.add('show');
        });
    });

    // pilih status
    statusModal.querySelectorAll('[data-status]').forEach(option => {
        option.addEventListener('click', () => {
            const status = option.dataset.status;

            activeBadge.innerText = option.innerText;
            activeBadge.className = 'badge status-btn';

            if (status === 'sedang diproses') activeBadge.classList.add('blue');
            if (status === 'menunggu approval') activeBadge.classList.add('orange');
            if (status === 'selesai') activeBadge.classList.add('green');

            statusModal.classList.remove('show');
            showToastStatus();
        });
    });

    closeStatusModal.onclick = () => {
        statusModal.classList.remove('show');
    };

    statusModal.addEventListener('click', (e) => {
        if (e.target === statusModal) {
            statusModal.classList.remove('show');
        }
    });

    function showToastStatus() {
        const toast = document.getElementById('toast');
        toast.querySelector('span').innerText = 'Status berhasil diperbarui';
        toast.classList.add('show');

        setTimeout(() => toast.classList.remove('show'), 2500);
    }
</script>


</body>

</html>