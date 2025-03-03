<div id="dashboard-menu" class="sidebar-container">
    <nav class="sidebar">
        <div class="sidebar-a">
            <a class="sidebar-item" href="dashboard.php">Dashboard</a>
            <a class="sidebar-item" href="venues.php">Venues</a>
            <a class="sidebar-item" href="services.php">Services</a>
            <a class="sidebar-item" href="features.php">Features</a>
        </div>
    </nav>
</div>

<script>
    function setActive() {
        let navbar = document.getElementById('dashboard-menu');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }
    setActive();
</script>