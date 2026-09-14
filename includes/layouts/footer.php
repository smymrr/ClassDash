</main>
</div>
<!-- Load page-specific JS files if defined -->
<?php if (!empty($scripts) && is_array($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="<?= htmlspecialchars($script) ?>" defer></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>

</html>