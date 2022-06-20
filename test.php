<!DOCTYPE HTML>

<html>

<head>
<title>Calendar</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="styles/gridlayout.css">
 <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- page content goes here -->
<p class="paligncenter">

<?php
    $localizedDaysOfWeek = array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa");
    $localizedMonths = array("", "Januar", "Februar", "Maerz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
    $day = 1;
    $month = 12;
    $year = 2022;
    $diff = 0;
    $diffEnd = 0;
    $weekStartOnMonday = 1;
    //$daysPerMonth = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    $daysPerMonth = intval(date('t', strtotime("$year-$month-1")));
    $maxTiles = 49 + 1; // 6 x 7 days + 1 (for loop)
    $color = "";
    $diffIndex = 0;

    echo "<div id='calendar' class='wrapper'>";

    for ($index = 0; $index < count($localizedDaysOfWeek); $index++)
    {
        if ($weekStartOnMonday == 1)
        {
            if ($diffIndex < count($localizedDaysOfWeek))
            {
                $diffIndex += $weekStartOnMonday;
            }
        }
        else
        {
            $diffIndex = $index;
        }

        if ($weekStartOnMonday == 1 && $diffIndex == count($localizedDaysOfWeek))
        {
            $diffIndex = 0;
        }

        echo "<span id='$localizedDaysOfWeek[$diffIndex]' class='tileWeekDaysAlignment' style='background-color:$color'>$localizedDaysOfWeek[$diffIndex]</span>";

    }

    for ($index = 1; $index < $maxTiles; $index++)
    {
        $dateString = "$year-$month-$day";
        $dayOfWeek = date('w', strtotime($dateString));
        if ($index == 1)
        {
            $diffEnd = $dayOfWeek;
            $diffStart = $diffEnd;
        }
        if ($dayOfWeek == 0)
        {
            $color = "#F9E6FA";  // Sunday
        }
        else
        {
            $color = "#E2E0E3"; // not Sunday
        }
        // booked by me = #ACD7AA
        // locked = #F98181
        // activities = #81D4F9
        // vacant = #D5F1FE
        // header = CAB7CB


        if ($diff < $diffEnd - $weekStartOnMonday)
        {
            echo "<span id=0>&nbsp;</span>";
            $diff++;
        }
        else if ($day < ($daysPerMonth + 1)) // $weekStartOnMonday
        {
            if ($dayOfWeek > 0)
            {
                echo "<span id='$dateString' class='tileMonthDayAlignment' style='background-color:$color'>$day ($dayOfWeek)</span>" . PHP_EOL;
            }
            else
            {
                echo "<span id='$dateString' class='tileMonthDayAlignment' style='background-color:$color'>$day ($dayOfWeek)</span>" . PHP_EOL;
            }
            $day++;
        }

    }
    echo "</div>";
?>

</p>
</body>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</html>