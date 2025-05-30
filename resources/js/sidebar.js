// resources/js/sidebar.js

document.addEventListener('DOMContentLoaded', function() {
    // Skrip untuk Dropdown CMS
    const cmsDropdownToggle = document.getElementById('cmsDropdownToggle');
    const cmsDropdownMenu = document.getElementById('cmsDropdownMenu');
    const cmsDropdownArrow = document.getElementById('cmsDropdownArrow');

    if (cmsDropdownToggle && cmsDropdownMenu) {
        cmsDropdownToggle.addEventListener('click', function() {
            cmsDropdownMenu.classList.toggle('hidden');
            if (cmsDropdownArrow) {
                cmsDropdownArrow.classList.toggle('rotate-90');
            }
        });
    }

    // Skrip untuk Dropdown Profil Lembaga
    const profilDropdownToggle = document.getElementById('profilDropdownToggle');
    const profilDropdownMenu = document.getElementById('profilDropdownMenu');
    const profilDropdownArrow = document.getElementById('profilDropdownArrow');

    if (profilDropdownToggle && profilDropdownMenu) {
        profilDropdownToggle.addEventListener('click', function() {
            profilDropdownMenu.classList.toggle('hidden');
            if (profilDropdownArrow) {
                profilDropdownArrow.classList.toggle('rotate-90');
            }
        });
    }
});