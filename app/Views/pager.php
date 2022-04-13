<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-center">
        <li class="page-item<?= !$pager->hasPrevious() ? ' disabled' : ''; ?>">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="First">
                <span aria-hidden="true">First</span>
            </a>
        </li>
        <li class="page-item<?= !$pager->hasPrevious() ? ' disabled' : ''; ?>">
            <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                <span aria-hidden="true">Previous</span>
            </a>
        </li>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item<?= $link['active'] ? ' active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <li class="page-item<?= !$pager->hasNext() ? ' disabled' : ''; ?>">
            <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Next">
                <span aria-hidden="true">Next</span>
            </a>
        </li>
        <li class="page-item<?= !$pager->hasNext() ? ' disabled' : ''; ?>">
            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Last">
                <span aria-hidden="true">Last</span>
            </a>
        </li>
    </ul>
</nav>