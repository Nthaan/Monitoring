<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Report Pengajuan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>

    <header class="topbar">
        <div class="topbar-left">
            <div class="logo">SC</div>
            <span class="app-name">Smart Campus</span>
        </div>

        <div class="topbar-right" style="display:flex;align-items:center;gap:12px;">

            <button id="themeToggle" class="theme-toggle" title="Ganti Tema">
                <i data-lucide="moon"></i>
            </button>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i data-lucide="log-out"></i>
                    Logout
                </button>
            </form>
        </div>
    </header>

    
    <div class="dashboard-layout">

        <div class="left-content" style="width:100%">
            <div class="card">

                <!-- HEADER TABLE -->
                <div class="table-header">
                    <h3>Report Pengajuan Layanan</h3>

                    <div class="table-actions">

                        <!-- SEARCH -->
                        <input type="text" class="search" placeholder="Cari laporan...">

                        <div class="filter-wrapper" id="jenisDropdown">
                            <i data-lucide="layers"></i>
                            <span id="jenisLabel">Semua Jenis</span>
                            <i data-lucide="chevron-down"></i>

                            <div class="filter-menu">
                                <div data-value="">Semua Jenis</div>
                                <div data-value="bimbingan">Bimbingan Skripsi</div>
                                <div data-value="surat">Surat Keterangan</div>
                                <div data-value="cuti">Pengajuan Cuti</div>
                            </div>
                        </div>

                        <div class="filter-wrapper" id="statusDropdown">
                            <i data-lucide="activity"></i>
                            <span id="statusLabel">Semua Status</span>
                            <i data-lucide="chevron-down"></i>

                            <div class="filter-menu">
                                <div data-value="">Semua Status</div>
                                <div data-value="sedang diproses">Sedang Diproses</div>
                                <div data-value="menunggu approval">Menunggu Approval</div>
                                <div data-value="selesai">Selesai</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- TABLE -->
                <table class="pengajuan-table">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Jenis Layanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>PIC</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Collei</td>
                            <td>Bimbingan Skripsi</td>
                            <td>20 Nov 2025</td>
                            <td><span class="badge blue">Sedang Diproses</span></td>
                            <td>Dosen Pembimbing</td>
                        </tr>

                        <tr>
                            <td>Alice</td>
                            <td>Surat Keterangan Aktif</td>
                            <td>18 Nov 2025</td>
                            <td><span class="badge orange">Menunggu Approval</span></td>
                            <td>Staff Akademik</td>
                        </tr>

                        <tr>
                            <td>Braine</td>
                            <td>Pengajuan Cuti</td>
                            <td>15 Nov 2025</td>
                            <td><span class="badge green">Selesai</span></td>
                            <td>Admin Fakultas</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <span>Smart Campus</span>
        <span>• built with cinta dan kasih AVV</span>
        <span class="footer-year">© 2025</span>
    </footer>

    <!--SCRIPT -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        const body = document.body;
        const toggle = document.getElementById('themeToggle');

        // load theme
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

        function initDropdown(wrapperId, labelId) {
            const dropdown = document.getElementById(wrapperId);
            const label = document.getElementById(labelId);
            const items = dropdown.querySelectorAll('.filter-menu div');

            dropdown.addEventListener('click', () => {
                dropdown.classList.toggle('show');
            });

            items.forEach(item => {
                item.addEventListener('click', (e) => {
                    e.stopPropagation();
                    label.innerText = item.innerText;
                    dropdown.classList.remove('show');
                });
            });

            document.addEventListener('click', (e) => {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                }
            });
        }

        initDropdown('jenisDropdown', 'jenisLabel');
        initDropdown('statusDropdown', 'statusLabel');
    </script>

</body>
</html>
