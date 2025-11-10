// Toggle sidebar
const sidebar = document.getElementById('sidebar');
const contentWrapper = document.getElementById('content-wrapper');
const sidebarToggle = document.getElementById('toggleSidebar');
const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');

function toggleSidebar() {
    sidebar.classList.toggle('collapsed');
    contentWrapper.classList.toggle('collapsed');

    // Store state in localStorage
    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
}

// Initialize sidebar state
if (localStorage.getItem('sidebarCollapsed') === 'true') {
    sidebar.classList.add('collapsed');
    contentWrapper.classList.add('collapsed');
}

// Event listeners
sidebarToggle.addEventListener('click', toggleSidebar);
mobileSidebarToggle.addEventListener('click', function() {
    sidebar.classList.toggle('show');
});

// Initialize dropdowns
document.addEventListener('DOMContentLoaded', function() {
    // Add rotate animation to user dropdown arrow
    const userDropdown = document.getElementById('userDropdown');
    const userArrow = userDropdown.querySelector('.topbar-user-arrow');

    userDropdown.addEventListener('show.bs.dropdown', function() {
        userArrow.style.transform = 'rotate(180deg)';
    });

    userDropdown.addEventListener('hide.bs.dropdown', function() {
        userArrow.style.transform = 'rotate(0deg)';
    });

    // Responsive behavior
    function handleResize() {
        if (window.innerWidth <= 992) {
            sidebar.classList.remove('show');
            if (!sidebar.classList.contains('collapsed')) {
                toggleSidebar();
            }
        } else {
            // Restore previous state for larger screens
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                contentWrapper.classList.add('collapsed');
            } else {
                sidebar.classList.remove('collapsed');
                contentWrapper.classList.remove('collapsed');
            }
        }
    }

    // Initialize and listen for resize
    window.addEventListener('load', handleResize);
    window.addEventListener('resize', handleResize);

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 992 &&
            !sidebar.contains(event.target) &&
            !mobileSidebarToggle.contains(event.target) &&
            sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        }
    });
});
