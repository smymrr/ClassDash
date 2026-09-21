// public/assets/js/components/sidebar.js
// Toggles the .is-open class on .cd-sidebar for the mobile slide-out drawer.
// Wire a button with id="sidebarToggle" in your topbar to use this.

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('cdSidebar');
    const backdrop = document.getElementById('cdSidebarBackdrop');
    const closeBtn = document.getElementById('cdSidebarClose');
    const toggleBtn = document.getElementById('cdSidebarToggle'); // Place this hamburger button in your main top header/nav

    if (!sidebar || !toggleBtn) {
        console.log("Sidebar not found");
        return
    }
    
    function openSidebar() {
        sidebar.classList.add('is-open');
        backdrop.classList.add('is-active');
        document.body.style.overflow = 'hidden'; // Prevents background scroll when menu is open
    }

    function closeSidebar() {
        sidebar.classList.remove('is-open');
        backdrop.classList.remove('is-active');
        document.body.style.overflow = '';
    }

    toggleBtn.addEventListener('click', openSidebar);
    closeBtn.addEventListener('click', closeSidebar);
    backdrop.addEventListener('click', closeSidebar);
});