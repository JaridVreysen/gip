<!-- Signout button  -->
<div class="navbar-nav d-none d-lg-inline-block">
    <?php if (isset($_SESSION['user'])): ?>
        <button class="btn btn-danger-soft mb-0" onclick="logout()">Sign Out</button>
    <?php else: ?>
        <a href="sign-in.php" class="btn btn-danger-soft mb-0">
            Sign in <i class="fas fa-sign-in-alt me-2"></i>
        </a>
    <?php endif; ?>
</div>