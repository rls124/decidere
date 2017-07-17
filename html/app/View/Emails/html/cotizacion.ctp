<table style="width:100%; border:0px solid #000000;">
	<tr style="background: #393746; color: #ffffff;">
		<td style="border:1px solid #000000; padding: 15px; font-size: 1.5em;">
			<h3 style="margin:0px; margin-bottom:10px;">Nombre</h3>
			<p style="margin:0px; font-size: 0.8em;"> <?php echo $dataAll['Car']['name'] ?> </p>
		</td>
		<td style="border:1px solid #000000; padding: 15px; font-size: 1.5em;">
			<h3 style="margin:0px; margin-bottom:10px;">Correo Electronico</h3>
			<p style="margin:0px; font-size: 0.8em;"> <?php echo $dataAll['Car']['email'] ?> </p>
		</td>
		<td style="border:1px solid #000000; padding: 15px; font-size: 1.5em;">
			<h3 style="margin:0px; margin-bottom:10px;">Teléfono</h3>
			<p style="margin:0px; font-size:0.83em;"> <?php echo $dataAll['Car']['phone'] ?> </p>
		</td>
	</tr>
	<tr>
		<td colspan="3" style="font-size: 1.5em; paddind:25px;">
			<h3 style="margin:0px; margin-bottom:20px; margin-top:20px;">Detalle de la consulta: <?php echo $dataAll['Car']['details'] ?></h3>
		</td>
	</tr>
	<tr style="border: 1px solid #000000; background: #B6B6B6;">
		<td> <h2 style="color: #393746; padding:10px; padding-bottom:0px;">Imágen</h2> </td>
		<td> <h2 style="color: #393746; padding:10px; padding-bottom:0px;">Producto</h2> </td>
		<td> <h2 style="color: #393746; padding:10px; padding-bottom:0px;">Cantidad</h2> </td>
	</tr>
	<?php foreach ($dataAll['Car']['items'] as $item) { ?>
		<tr style="font-size: 1.5em;">
			<td style="text-align: center;">
				<img src="http://www.deluz-srl.com/<?php echo $item['image'] ?>" alt="" style="max-width:150px;">
			</td>
			<td>
				<p style="margin:0px; padding:10px;"> <?php echo $item['name'] ?> </p>	
			</td>
			<td>
				<p style="margin:0px; padding:10px;"> <?php echo $item['amount'] ?> </p>
			</td>
		</tr>	
	<?php } ?>
	
</table>
<hr>