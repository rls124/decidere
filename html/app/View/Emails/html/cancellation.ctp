<style>
	table {
		width:600px;
		margin: 40px auto;
		border-collapse: collapse;
		border:1px solid #000;
		font-family: Arial,Helvetic,San-Serif;
		font-size: 14px;
	}
	table td {
		padding:10px;
	}
	h1 {
		font-family: Arial,Helvetic,San-Serif;
		font-size: 24px;
		padding:10px;
		margin:0;
	}
	.header {
		background: #E74F06;
		color:#fff;		
		border-bottom:1px solid #000;
	}
</style>

<table>
	<tr class="header">
		<td>
			<h1>Decidere Dataset Cancellation</h1>
		</td>
	</tr>
	<tr>
		<td> <strong> User Name: </strong> <?php echo $dataAll['User']['first_name']." ".$dataAll['User']['last_name'];  ?></td>
	</tr>
	<tr>
		<td> <strong> Email: </strong> <?php echo $dataAll['User']['email']; ?></td>
	</tr>
	<tr>
		<td> <strong> Phone: </strong> <?php echo $dataAll['User']['phone']; ?></td>
	</tr>
	<tr>
		<td> <strong> Dataset: </strong> <?php echo $dataAll['UserProvider']['name']; ?></td>
	</tr>
	
</table>
<hr>
