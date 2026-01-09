<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li>
                    <a href="/dashboard"><i class="feather-grid"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-server"></i> <span> Master</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="/role"> Role</a></li>
                        <li><a href="/pegawai"> Pegawai</a></li>
                        <li><a href="/users"> Users</a></li>
                        <li><a href="/driver"> Driver</a></li>
                        <li><a href="/suplier"> Suplier</a></li>
                        <li><a href="/kendaraan"> kendaraan</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const path = window.location.pathname;
        const sidebar = document.getElementById('sidebar-menu');

        if (!sidebar) return;

        // Reset
        sidebar.querySelectorAll('.active, .subdrop').forEach(el => {
            el.classList.remove('active', 'subdrop');
        });
        sidebar.querySelectorAll('.submenu ul').forEach(ul => {
            ul.style.display = 'none';
        });

        // Cari link aktif
        let activeLink = null;
        const links = sidebar.querySelectorAll('a[href]');

        // Cari exact match
        for (let link of links) {
            if (link.getAttribute('href') === path) {
                activeLink = link;
                break;
            }
        }

        // Dashboard fallback
        if (!activeLink && (path === '/' || path === '/dashboard')) {
            activeLink = sidebar.querySelector('a[href="/dashboard"]');
        }

        // Jika ditemukan
        if (activeLink) {
            // Selalu aktifkan link
            activeLink.classList.add('active');

            const parentLi = activeLink.parentElement;

            if (parentLi && parentLi.tagName === 'LI') {
                // PERBEDAAN: Periksa tipe menu
                const href = activeLink.getAttribute('href');

                // Jika DASHBOARD: aktifkan <li>
                if (href === '/dashboard') {
                    parentLi.classList.add('active');
                }
                // Jika dalam SUBMENU: buka parent submenu
                else {
                    const parentSubmenu = activeLink.closest('li.submenu');
                    if (parentSubmenu) {
                        parentSubmenu.classList.add('active');

                        const toggle = parentSubmenu.querySelector('a[href="#"]');
                        if (toggle) {
                            toggle.classList.add('active', 'subdrop');
                        }

                        const subUl = parentSubmenu.querySelector('ul');
                        if (subUl) {
                            subUl.style.display = 'block';
                        }
                    }
                }
            }
        }
    });
</script>

