<?php
// don't load directly
defined( 'ABSPATH' ) || die( '-1' );

if ( class_exists( 'Dashed_Slug_Wallets_Coin_Adapter_RPC' ) && ! class_exists( 'Dashed_Slug_Wallets_Bitsend_RPC_Adapter' ) ) {

	final class Dashed_Slug_Wallets_Bitsend_RPC_Adapter extends Dashed_Slug_Wallets_Coin_Adapter_RPC {

		// helpers

		// settings api

		// section callbacks

		/** @internal */
		public function section_fees_cb() {
			if ( ! current_user_can( 'manage_wallets' ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets-bitsend' ) );
			}

			?><p><?php esc_html_e( 'You can set two types of fees:', 'wallets-bitsend'); ?></p>
				<ul>
					<li>
						<strong><?php esc_html_e( 'Transaction fees', 'wallets-bitsend' )?></strong> &mdash;
						<?php esc_html_e( 'These are the fees a user pays when they send funds to other users.', 'wallets-bitsend' )?>
					</li><li>
						<p><strong><?php esc_html_e( 'Withdrawal fees', 'wallets-bitsend' )?></strong> &mdash;
						<?php esc_html_e( 'This the amount that is subtracted from a user\'s account in addition to the amount that they send to another address on the blockchain.', 'wallets-bitsend' )?></p>
						<p><?php echo __( 'Fees are calculated as: <i>total_fees = fixed_fees + amount * proportional_fees</i>.', 'wallets-bitsend' ); ?></p>
						<p class="card"><?php esc_html_e( 'This withdrawal fee is NOT the network fee, and you are advised to set the withdrawal fee to an amount that will cover the network fee of a typical transaction, possibly with some slack that will generate profit. To control network fees use the paytxfee setting in bitsend.conf', 'wallets-bitsend' ) ?>
						<a href="https://manpages.debian.org/testing/bitsend/bitsend.conf.5.en.html" target="_blank"><?php esc_html_e( 'Refer to the documentation for details.', 'wallets-bitsend' )?></a></p>
					</li>
				</ul><?php
		}

		// input field callbacks

		// API

		public function get_adapter_name() {
			return 'BitSend core node';
		}

		public function get_name() {
			return 'BitSend';
		}

		public function get_sprintf() {
			return mb_convert_encoding('&#x110;', 'UTF-8', 'HTML-ENTITIES') . '%01.8f';
		}

		public function get_symbol() {
			return 'BSD';
		}

		public function get_icon_url() {
			return plugins_url( '../assets/sprites/bitsend-logo.png', __FILE__ );
		}
	}
}
