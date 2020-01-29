<div class="vw-100 vh-100 d-flex justify-content-center align-items-center">
    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-3">Page Not Found</p>
        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
        <?php
        $url = (int) $_COOKIE['role'] === 0 ? "user" : (int) $_COOKIE['role'] === 1 ? "petugas" : "admin";
        ?>
        <a href="<?= BASE_URL . $url ?>">&larr; Back to Dashboard</a>
    </div>
</div>