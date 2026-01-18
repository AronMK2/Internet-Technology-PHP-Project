<?php
?>
<header>
    <div class="nav">
        <div class="brand"><span>PhoneX</span></div>
        <div class="hamburger" id="hamburger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav id="navbar-links">
            <a href="index.php">Kezdőlap</a>
            <a href="offers.php">Termékek</a>
            <a href="about.php">Rólunk</a>
            <a href="contact.php">Kapcsolat</a>
            <a href="order.php">Megrendelés</a>
            <a href="admin/index.php">Admin</a>
        </nav>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.getElementById('hamburger-menu');
        const navLinks = document.getElementById('navbar-links');
        hamburger.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            hamburger.classList.toggle('active');
        });
    });
    </script>
</header>
