<table style="width:100%; border:0px solid #000000;">
	<tr style="background: #393746; color: #ffffff;">
		<td style="border:1px solid #000000; padding: 15px; font-size: 1.5em;">
			<h3 style="margin:0px; margin-bottom:10px;">Nombre</h3>
			<p style="margin:0px; font-size: 0.8em;"> <?php echo $dataAll['Consulting']['name'] ?> </p>
		</td>
		<td style="border:1px solid #000000; padding: 15px; font-size: 1.5em;">
			<h3 style="margin:0px; margin-bottom:10px;">Correo Electronico</h3>
			<p style="margin:0px; font-size: 0.8em;"> <?php echo $dataAll['Consulting']['email'] ?> </p>
		</td>
		<td style="border:1px solid #000000; padding: 15px; font-size: 1.5em;">
			<h3 style="margin:0px; margin-bottom:10px;">Teléfonos</h3>
			<p style="margin:0px; font-size: 0.8em;"> <?php echo $dataAll['Consulting']['phones'] ?> </p>
		</td>
	</tr>
	<tr>
		<td colspan="4" style="font-size: 1.5em;">
			<h3 style="margin:0px; margin-bottom:20px; margin-top:20px;">Asunto: <?php echo $dataAll['Consulting']['subject'] ?></h3>
		</td>
	</tr>
	<tr>
		<td colspan="4" style="font-size: 1.5em;">
			<h3 style="margin:0px; margin-bottom:10px;">Mensaje</h3>
			<p style="margin:0px; font-size: 0.8em;"> <?php echo $dataAll['Consulting']['message'] ?> </p>
		</td>
	</tr>
</table>
<hr>