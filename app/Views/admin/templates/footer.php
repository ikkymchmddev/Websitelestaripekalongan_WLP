        </div>
    </div>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.querySelector('.admin-main').classList.toggle('expanded');
        });
    </script>
</body>
</html>
