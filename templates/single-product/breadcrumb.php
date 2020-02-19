<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {

	echo $wrap_before; // XSS Ok

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before; // XSS Ok

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo esc_html( $crumb[0] );
		}

		echo $after; // XSS Ok

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {

		}
	}

	echo $wrap_after; // XSS Ok

}
