<?php

// Get notice archive layout
if ( ! function_exists( 'lsvr_pressville_get_notice_archive_layout' ) ) {
	function lsvr_pressville_get_notice_archive_layout() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		return 'default';

	}
}

?>