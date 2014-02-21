<div class="span10 form">
	<br><br>
	<h2><?php echo __($title); ?></h2>
	<br><br>
	</script>
    <table class="table-hover table-condensed" cellpadding="0" cellspacing="0">
        <tr>
            <th>First name</th>
            <th>Last name</th>
			<th>Short phone number</th>
			<th>External phone number</th>
			<th>SIP account</th>
			<th>Password</th>
        </tr>
        <?php foreach($listUser as $user): ?>
	<tr>
		<td><?php print $user["firstname"] ?></td>
		<td><?php print $user["lastname"] ?></td>
		<td><?php print $user["line"]["number"] ?></td>
		<td><?php print $user["userfield"] ?></td>
		<td><?php print $user["username"] ?></td>
		<td><?php print $user["password"] ?></td>
    </tr>         
        <?php endforeach; ?>
    </table>
	<div class="paging">
        
    </div>
    <br><br><br><br>
</div>


</div>
