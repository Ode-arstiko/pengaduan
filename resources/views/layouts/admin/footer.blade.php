</main>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById("dropdown-menu");
        dropdown.classList.toggle("hidden");
    }

    const toggleSidebarBtn = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");

    function toggleDropdown() {
        const menu = document.getElementById("dropdown-menu");
        menu.classList.toggle("hidden");
    }

    // Tutup dropdown saat klik di luar
    window.addEventListener("click", function (e) {
        const btn = document.querySelector("button[onclick='toggleDropdown()']");
        const menu = document.getElementById("dropdown-menu");

        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add("hidden");
        }
    });

    toggleSidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("-translate-x-full");
    });

    // Close dropdown when clicking outside
    window.addEventListener("click", function (e) {
        const menu = document.getElementById("dropdown-menu");
        if (!e.target.closest("button") && !e.target.closest("#dropdown-menu")) {
            menu.classList.add("hidden");
        }
    });

</script>
</body>

</html>