// public/assets/js/components/sidebar.js
// Toggles the .is-open class on .cd-sidebar for the mobile slide-out drawer.
// Wire a button with id="sidebarToggle" in your topbar to use this.

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.cd-sidebar');

    if (!toggleBtn || !sidebar) {
        return;
    }

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('is-open');
    });
});
