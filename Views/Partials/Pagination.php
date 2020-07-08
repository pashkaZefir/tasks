<nav class="row justify-content-center m-2">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++) { ?>
            <li class="page-item <?php if ($i === $current || ($current === 0 && $i === 1)) echo 'active'; ?>">
                <a class="page-link" href="?page=<?= $i ?><?php if ($saveOrder) echo "&$saveOrder" ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
