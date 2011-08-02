<?php

/*
 * Status Message Class
 *
 * Easy way to deal with statuses in PHP
 *
 * @author Galen Grover <galenjr@gmail.com>
 * @package StatusMesssage
 *
 * @link https://github.com/galen/FormStatusMessage
 * 
 */

class StatusMessage {

	/*
	 * Array of statuses
	 *
	 * @var array
	 */
	private $statuses = array();
	
	/*
	 * The status message
	 *
	 * @var string
	 */
	private $message;

	/*
	 * The status message template
	 * This is used in getHtml();
	 *
	 * @var string
	 */
	private $template = '<p id="status_message" class="{status}">{message}</p>';

	/*
	 * Set the html template
	 *
	 * {status} will be replaced with the status
	 * {message} will be replaced with the message
	 *
	 * @param string $template html template to use
	 * @return void
	 */
	function setTemplate( $template ) {
		$this->template = $template;
	}

	/*
	 * Set the status
	 *
	 * @param string $status The status
	 * @return void
	 */
	function setStatus( $status ) {
		$this->statuses[] = $status;
	}

	/*
	 * Set the statuses
	 *
	 * @param array $statuses The statuses
	 * @return void
	 */
	function setStatuses( array $statuses ) {
		foreach( $statuses as $status ) {
			$this->setStatus( $status );
		}
	}

	/*
	 * Set the status message
	 *
	 * @param string $status The status message
	 * @return void
	 */
	function setMessage( $message ) {
		$this->message = $message;
	}

	/*
	 * Get the status message
	 *
	 * @return string
	 */
	function getMessage() {
		return $this->message;
	}

	/*
	 * Get a status
	 *
	 * @param int $id Index of the status to get. Defaults to the first.
	 * @return string
	 */
	function getStatus( $index=0 ) {
		return isset( $this->statuses[$index] ) ? $this->statuses[$index] : null;
	}

	/*
	 * Get all statuses
	 *
	 * @param string $separator String to implode the statuses with
	 * @return string
	 */
	function getStatuses( $separator = ' ' ) {
		return implode( $separator, $this->statuses );
	}

	/*
	 * Convenience function
	 * Uses the template as the html
	 *
	 * @return string
	 */
	function getHtml() {
		$replace_what = array( '{status}', '{message}' );
		$replace_with = array( $this->getStatuses(), $this->getMessage() );
		return str_replace( $replace_what, $replace_with, $this->template );
	}

	/*
	 * Magic __toString function
	 *
	 * This will print the status message html if a message has been set
	 * If you don't make sure a StatusMessage has been instantiated you will get an
	 * E_NOTICE warning about an unset variable
	 *
	 * Put this in your html
	 * <?php echo isset( $status_message ) ? $status_message : '' ?>
	 *
	 * @return void
	 */
	function __toString() {
		if ( isset( $this->message ) ) {
			return $this->getHtml();
		}
	}

}

