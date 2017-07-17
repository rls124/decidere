
<style>
	body {
		font-family: Arial, Helvetica, San-Serif;
		font-size: 14px;
	}
	.content {
		margin: 40px 80px;
	}
	h1 {
		padding:20px;
		margin: 0;
		background-color: #F75404;
		color:#fff;
		font-size: 30px;
	}
</style>
<body>
<h1>Decidere Password Reset</h1>

<div class="content">
	<p>Click on the link below or copy and paste it into your browsers address bar. You will be redirected to the Decidere Password Reset page.</p>	
	<a href="https://<?php echo $dataAll['domain']; ?>/reset/password/<?php echo $dataAll['User']['reset_key']; ?>">https://<?php echo $dataAll['domain']; ?>/reset/password/<?php echo $dataAll['User']['reset_key']; ?></a>
</div>
</body>
