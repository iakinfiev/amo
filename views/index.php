<!DOCTYPE html>
<html>
<head>
	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Table</title>
</head>
<body>
	<?php	 
	 include '../models/Accounts.php';
	?>
	<?php if (count($listsClient) > 0): ?>
	<table class="table table-sm table-primary" style="padding:20px;">
		<caption style="caption-side:top;text-align:center;">Cумма закрытых сделок по всем нашим клиентам</caption>
		<thead>
			<tr>
				<th scope="col"><?php echo implode('</th><th>', array_keys(current($listsClient))); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($listsClient as $row): array_map('htmlentities', $row); ?>
	    	<tr>
				<td scope="row"><?php echo implode('</td><td>', $row); ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
		    <tr>
		      <td scope="row" colspan="2" style="text-align:end;padding-right:50px;">Sum:</td>
		      <td scope="row"><?php echo $allPrice; ?></td>
		    </tr>
  		</tfoot>
	</table>
	<?php endif; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>        
</body>
</html>