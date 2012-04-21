<?php

ini_set( 'display_errors', 'On' );
error_reporting( E_ALL );

if ( isset( $_GET['value'] ) ) {
	require( 'FormStatusMessage.php' );
	if ( is_numeric( $_GET['value'] ) ) {
		$status_message = new FormStatusMessage;
		$status_message->setStatus( 'success' );
		$status_message->setMessage( 'You have entered a valid number' );
		// If you enter a number greater than 100 this status will be added
		if ( $_GET['value'] > 100 ) {
			$status_message->setStatus( 'gt100' );
		}
	}
	else {
		$status_message = new FormStatusMessage;
		$status_message->setStatus( 'error' );
		// If you don't enter a value this status will be added
		if ( trim( $_GET['value'] ) == '' ) {
			$status_message->setStatus( 'empty' );
		}
		$status_message->setMessage( 'Please enter a valid number' );
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<style type="text/css">
#status_message { font-weight: bold; background: #eee; border: 1px solid #ddd; }
#status_message.error { color: red }
#status_message.success { color: green }
#status_message.gt100 { font-size:2em }
#status_message.empty { font-size:2em }
</style>
</head>
<body>
<h1>Please enter a number</h1>

<?php if ( isset( $status_message ) ): ?>
<?php echo $status_message->getHtml() ?>
<?php endif; ?>

<?php if ( isset( $status_message ) ): ?>
<p id="status_message" class="<?php echo $status_message->getStatuses() ?>"><?php echo $status_message->getMessage(); ?></p>
<?php endif; ?>

<?php echo isset( $status_message ) ? $status_message : '' ?>

<form action="">
<input type="text" name="value"><input type="submit">
</form>
</body>
</html>