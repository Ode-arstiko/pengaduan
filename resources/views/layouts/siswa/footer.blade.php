<script>
    // Toggle Dropdown for User Profile
    function toggleDropdown() {
        const dropdown = document.getElementById("dropdown-menu");
        dropdown.classList.toggle("hidden");
    }

    // Toggle Sidebar for Mobile
    const toggleSidebarBtn = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById('sidebar-overlay');

    toggleSidebarBtn.addEventListener("click", () => {
        sidebar.classList.remove("-translate-x-full");

        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');
    });

    // Close Dropdown and Sidebar when clicking outside
    window.addEventListener("click", function(e) {
        const profileButton = document.querySelector("button[onclick='toggleDropdown()']");
        const dropdownMenu = document.getElementById("dropdown-menu");

        // Close profile dropdown
        if (profileButton && !profileButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add("hidden");
        }

        // Close sidebar if open and clicked outside on small screens
        // Check if sidebar is NOT hidden (-translate-x-full) and click is outside sidebar and toggle button
        if (window.innerWidth < 640 && !sidebar.contains(e.target) && !toggleSidebarBtn.contains(e.target) && !
            sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add("-translate-x-full");

            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0', 'pointer-events-none');
        }
    });
</script>
</body>

</html>
