<?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <?php echo $pager->getPage() == 1 ? '<span class="disabledPagination">Premier</span>' : link_to('Premier', $route . '?page=' . $pager->getFirstPage()) ?>
        <?php echo $pager->getPage() == 1 ? '<span class="disabledPagination">Précédent</span>' : link_to('Précédent', $route . '?page=' . $pager->getPreviousPage()) ?>

        <?php foreach ($pager->getLinks() as $page): ?>
            <?php if ($page == $pager->getPage()): ?>
                <span class="activeLink"><?php echo $page ?></span>
            <?php else: ?>
                <span><?php echo link_to($page, $route . '?page=' . $page) ?></span>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php echo $pager->getPage() == $pager->getLastPage() ? '<span class="disabledPagination">Suivant</span>' : link_to('Suivant', $route . '?page=' . $pager->getNextPage()) ?>
        <?php echo $pager->getPage() == $pager->getLastPage() ? '<span class="disabledPagination">Dernier</span>' : link_to('Dernier', $route . '?page=' . $pager->getLastPage()) ?>
    </div>
<?php endif; ?>
