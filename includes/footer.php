<p>&copy;
    <?php
        $startYear = 2015;
        $thisYear = date('Y');

        if ($startYear == $thisYear) {
            echo $startYear;
        } else {
            echo "{$startYear}&ndash;{$thisYear}";
        }
    ?>
Viktor Saevarsson and everyone else in the world</p>