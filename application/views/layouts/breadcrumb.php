<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php
        $cont = 1;
        foreach ($miga as $k => $v) {
            if ($cont === count($miga)) {
                echo '<li class="breadcrumb-item active" aria-current="page">' . $k . '</li>';
            }
            else {
                echo '<li class="breadcrumb-item"><a href="' . base_url($v) . '">' . $k . '</a></li>';
            }
            $cont += 1;
        }
        ?>
    </ol>
</nav>