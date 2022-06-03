<!DOCTYPE HTML>

<html>

<head>
<title>Calendar</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
 <link rel="stylesheet" href="styles/gridlayout.css">
</head>

<body>

<!-- page content goes here -->
<div id="calendar" class="wrapper">
<?php
    $localizedDaysOfWeek = array("So", "Mo", "Di", "Mi", "Do", "Fr", "Sa");
    $localizedMonths = array("", "Januar", "Februar", "Maerz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
    $day = 1;
    $month = 7;
    $year = 2022;
    $diff = 0;
    $diffEnd = 0;
    $weekStartOnMonday = 1;
    $daysPerMonth = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    $maxTiles = 49 + 1; // 6 x 7 days + 1 (for loop)
    $color = "";
    $diffIndex = 0;

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

        echo "<span id='$localizedDaysOfWeek[$diffIndex]' style='background-color:$color'>$localizedDaysOfWeek[$diffIndex]</span>";
    }

    for ($index = 1; $index < $maxTiles; $index++)
    {
        $dateString = "$year-$month-$day";
        $dayOfWeek = date('w', strtotime($dateString));
        if ($index == 1)
        {
            $diffEnd = $dayOfWeek;
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
                echo "<span id=$dateString style='background-color:$color'>$day ($dayOfWeek)</span>";
            }
            else
            {
                echo "<span id=$dateString style='background-color:$color'>$day ($dayOfWeek)</span>";
            }
            $day++;
        }
    }
?>
</div>

</body>

</html>