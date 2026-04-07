    <!-- Paginación -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($paginaActual > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?<?php echo $paginaUrlVar?>&pagina=<?php echo $paginaActual - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>

                <li class="page-item">
                    <a class="page-link <?php echo (isset($_GET['pagina']) && $_GET['pagina'] == $i) ? "active" : ""  ?>" href="index.php?<?php echo $paginaUrlVar?>&pagina=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($paginaActual < $totalPaginas): ?>
                <li class="page-item">
                    <a class="page-link " href="index.php?<?php echo $paginaUrlVar?>&pagina=<?php echo $paginaActual + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>