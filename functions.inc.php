<?php

function is_valid_email($email){
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

?>