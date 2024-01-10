
<?php


include_once("config.php");

session_start();

?>


<?php

include 'config.php';

if(isset($_POST['parent_id']))
{
	extract($_POST);
	$qry=mysqli_query($conn,"select Country from cities  where Country=$parent_id'");
	while ($res = mysqli_fetch_array($qry)) 
	{
		$cname=$res['country'];
		echo $cname;
	}
}


if(isset($_POST['parent_id1']))
{
	extract($_POST);
	$qry1=mysqli_query($conn,"select DISTINCT State from cities where State='$parent_id1'");
	while ($res = mysqli_fetch_array($qry1)) 
	{
		$state=$res['State'];
		echo $state;
	}


if(isset($_POST['parent_id2']))
{
	extract($_POST);
	$qry2=mysqli_query($conn,"select DISTINCT City from cities where City='$parent_id2'");
	while ($res = mysqli_fetch_array($qry2)) 
	{
		$City=$res['City'];
		echo $City;
	}


if(isset($_POST['parent_id3']))
{
	extract($_POST);
	$qry2=mysqli_query($conn,"select DISTINCT Emp_Email from crm_contact where Emp_Email='$parent_id3'");
	while ($res = mysqli_fetch_array($qry2)) 
	{
		$Emp_Email=$res['Emp_Email'];
		echo $Emp_Email;
	}

if(isset($_POST['parent_id4']))
{
	extract($_POST);
	$qry4=mysqli_query($conn,"select contact_first from crm_contact  where contact_first='$parent_id4'");
	while ($res = mysqli_fetch_array($qry4)) 
	{
		$contact_first=$res['contact_first'];
		echo $contact_first;
	}



	if(isset($_POST['parent_id5']))
{
	extract($_POST);
	$qry5=mysqli_query($conn,"select company,id from crm_contact  where company='$parent_id5'");
	while ($res = mysqli_fetch_array($qry5)) 
	{
		$id=$res['id'];
		echo $id;
	}



	if(isset($_POST['parent_id6']))
{
	extract($_POST);
	$qry6=mysqli_query($conn,"select tasktype from crm_tasktype  where tasktype='$parent_id6'");
	while ($res = mysqli_fetch_array($qry6)) 
	{
		$tasktype=$res['tasktype'];
		echo $tasktype;
	}


if(isset($_POST['parent_id7']))
{
	extract($_POST);
	$qry7=mysqli_query($conn,"select * from crm_contact  where id='$parent_id7'");
	while ($res = mysqli_fetch_array($qry7)) 
	{
		$id=$res['id'];
		echo $id;
	}



if(isset($_POST['parent_id8']))
{
	extract($_POST);
	$qry8=mysqli_query($conn,"select Ind_Type from crm_industry  where Ind_Type='$parent_id8'");
	while ($res = mysqli_fetch_array($qry8)) 
	{
		$Ind_Type=$res['Ind_Type'];
		echo $Ind_Type;
	}
if(isset($_POST['parent_id9']))
{
	extract($_POST);
	$qry2=mysqli_query($conn,"select DISTINCT district from cities where district='$parent_id9'");
	while ($res = mysqli_fetch_array($qry2)) 
	{
		$district=$res['district'];
		echo $district;
	}

include_once("config.php");

if (isset($_GET['state'])) {
    $state = $_GET['state'];
    $sql = "SELECT District FROM cities WHERE State = '" . $state . "'";
    $result = $conn->query($sql);

    $districts = array();
    while ($row = $result->fetch_assoc()) {
        $districts[] = $row['District'];
    }

    echo json_encode($districts);
}

?>