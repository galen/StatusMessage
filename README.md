#Status Message

An easy way to deal with status messages

---

When someone fills out a form you usually need to display a status (error, success, etc). This class provides a simple interfacing for doing so.

There are two main parts to a status message

 - Status: Statuses translate to classes attached to the message container
 - Message: Message displayed to the user

<a href="http://www.galengrover.com/projects/StatusMessage/example.php">Live example</a>

##Usage

### PHP code

	if ( isset( $_GET['value'] ) ) {
		require( 'StatusMessage.php' );
		if ( is_numeric( $_GET['value'] ) ) {
			$status_message = new StatusMessage;
			$status_message->setStatus( 'success' );
			$status_message->setMessage( 'You have entered a valid number' );
			// If you enter a number greater than 100 this status will be added
			if ( $_GET['value'] > 100 ) {
				$status_message->setStatus( 'gt100' );
			}
		}
		else {
			$status_message = new StatusMessage;
			$status_message->setStatus( 'error' );
			// If you don't enter a value this status will be added
			if ( trim( $_GET['value'] ) == '' ) {
				$status_message->setStatus( 'empty' );
			}
			$status_message->setMessage( 'Please enter a valid number' );
		}
	}

###CSS code to style the status message
	<style type="text/css">
	#status_message { font-weight: bold; background: #eee; border: 1px solid #ddd; }
	#status_message.error { color: red }
	#status_message.success { color: green }
	#status_message.gt100 { font-size:2em }
	#status_message.empty { font-size:2em }
	</style>

###HTML code

Here is the form used in this example:

		<form action="">
		<input type="text" name="value"><input type="submit">
		</form>

There are 3 ways to output the html:

1. Use your own html and insert the variables in it.

		<?php if ( isset( $status_message ) ): ?>
		<p id="status_message" class="<?php echo $status_message->getStatuses() ?>"><?php echo $status_message->getMessage(); ?></p>
		<?php endif; ?>

2. Use the getHtml() function. This function returns the html set via setTemplate().

		<?php if ( isset( $status_message ) ): ?>
		<?php echo $status_message->getHtml() ?>
		<?php endif; ?>

3. Using the __toString() magic method just echo the status message. This will only echo if a message has been set.

		<?php echo isset( $status_message ) ? $status_message : '' ?>
