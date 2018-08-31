<meta charset="utf-8">
<?php 
session_start();
if(!isset($_SESSION['login']))
{
    // not logged in
	header('Location: login.php');
	exit();
}
?>

<div class="col-md-12" style="width:100%;margin-top:15px;">
	<div class="box-body" style="display: block;">
	</div>
	<table style="width: 100%;">
		<tbody><tr>
			<td style="width: 40%;">
				<img src="img/LOGO-ANHEMBI-MORUMBI-MAIOR-300x128.png" height="50px;" width="120px;">
			</td>
			<td style="width: 50%;">
				<h1 class="box-title"></h1>
				<div class="box-tools pull-right">
				</div></td>
				<td style="width: 10%;">
					<img src="img/Laureate_International_Universities_Logo.png" height="40px;" width="150px;">
				</td>
			</tr>
		</tbody></table>
	</div>