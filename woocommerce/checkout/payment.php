<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
<?/*************** HU click conversion code ****************/?>
<?php if (get_option('shop_id') == 'HU'):?>
	<script type="text/javascript">
	  /* <![CDATA[ */
	  goog_snippet_vars = function() {
	    var w = window;
	    w.google_conversion_id = 855443647;
	    w.google_conversion_label = "ScZtCLSGzHEQv5H0lwM";
	    w.google_conversion_value = 1.00;
	    w.google_conversion_currency = "HUF";
	    w.google_remarketing_only = false;
	  }
	  // DO NOT CHANGE THE CODE BELOW.
	  goog_report_conversion = function(url) {
	    goog_snippet_vars();
	    window.google_conversion_format = "3";
	    var opt = new Object();
	    opt.onload_callback = function() {
	    if (typeof(url) != 'undefined') {
	      window.location = url;
	    }
	  }
	  var conv_handler = window['google_trackConversion'];
	  if (typeof(conv_handler) == 'function') {
	    conv_handler(opt);
	  }
	}
	/* ]]> */
	</script>
<?php endif; ?>
<script type="text/javascript"
  src="//www.googleadservices.com/pagead/conversion_async.js">
</script>

<div id="payment" class="woocommerce-checkout-payment">
	<?php if ( WC()->cart->needs_payment() ) : ?>
		<ul class="wc_payment_methods payment_methods methods">
			<?php
				if ( ! empty( $available_gateways ) ) {
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				} else {
					echo '<li>' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_country() ? __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : __( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>';
				}
			?>
		</ul>
	<?php endif; ?>
	<div class="form-row place-order">
		<noscript>
			<?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?>
			<br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>" />
		</noscript>

		<?php wc_get_template( 'checkout/terms.php' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '"  onclick="goog_report_conversion('.$order_button_text.')" />' ); ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>
	</div>
</div>
<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}