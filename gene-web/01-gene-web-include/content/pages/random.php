<p>Top náhodné číslo: <?php echo mt_rand(100, 999); ?></p>
<ul>
    <?php
    for ($i = 1; $i <= 10; $i++) {
        echo "<li>";
        echo mt_rand(0, 999999);
        echo "</li>";
    }
    ?>
</ul>
<p>To je super, ne?</p>