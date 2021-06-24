<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Countdown Timer</title>

</head>

<body>
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("bidding", $con);

$result = mysql_query("SELECT * FROM bids WHERE id = 1");

$numrow = mysql_num_rows($result);

if ($numrow == 0)
{
	die('No record found.');
}

$row = mysql_fetch_row($result);
echo "Description: " . $row[1] . "<br />";
$closedate = date_format(date_create($row[2]), 'm/d/Y H:i:s');
echo "Closing Date: " . $closedate;
?>
<p>Time Left:
<script language="JavaScript">
TargetDate = "<?php echo $closedate ?>";
BackColor = "palegreen";
ForeColor = "navy";
CountActive = true;
CountStepper = -1;
LeadingZero = true;
DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
FinishMessage = "Bidding closed!";
</script>
<script language="JavaScript" src="countdown.js"></script>
</p>
<p>For more free source code visit <a href="http://www.sourcecodester.com">www.sourcecodester.com</a></p>
</body>
</html>
