<style type="text/css">
.ssd_stripe_syncr_button div {
	float: left;
	margin: 0 10% 15px 0px;
}
.wrap.form-main-div {
	float: left;
	width: 100%;
	margin: 80px 0 0;
	position: relative;
}
.form-image {
	margin: 0 auto;
	max-width: 13% !important;
	top: -73px;
	position: absolute;
	left: 0;
	right: 0;
}
.synchronise_chardnerd_data_right {
	float: right !important;
	margin-right: 0 !important;
}
.ssd_stripe_form_fields {
	margin-top: 0px;
	width: 48%;
	float: left;
	margin: 15px 0 0 0;

}

.ssd_stripe_wrapper {
	margin: 0 auto;
	width: 50% !important;
	background: #f4f4f4;
	padding: 70px 40px 35px;
	clear: both;
}
.ssd_stripe_form_fields.password-field {
	width: 100%;
}
.ssd_stripe_form input[type="submit"] {
	margin: 30px 0 5px;
}
.ssd_stripe_form_fields:nth-child(2n+2) {
	float: right;
}
@media only screen and (max-width: 991px) {
	.form-image{
		max-width: 15% !important;
		top: -65px;
	}
	.ssd_stripe_form_fields label {
		font-size: 14px;
	}
	.form-heading {
    font-size: 24px;
}
.ssd_stripe_wrapper{
	width: 60% !important;
}

}
@media only screen and (max-width: 768px) {
.ssd_stripe_form_fields{
	width: 100% !important;
}
.ssd_stripe_wrapper{
	padding-top:25px;
}
.ssd_stripe_syncr_button div{
	width: 100%;

}
.ssd_stripe_syncr_button input{
	width: 100%;
}

.ssd_stripe_wrapper {
    width: 70% !important;
}
.ssd_stripe_form input[type="submit"]{
	margin-bottom: 0;
}
.form-image{
	max-width: 15% !important;
	top: -45px !important;
}
.synchronise_chardnerd_data_right {
    margin: 10px 0 30px 0 !important;
}
}
@media only screen and (max-width: 450px) {
	.form-image {
    max-width: 25% !important;
}
}
</style>
<?php  get_header(); ?>
<div class="wrap form-main-div">
	<?php if( is_user_logged_in() && current_user_can('administrator') ){

		

		$user_id = intval(get_current_user_id());
		if(get_option('stripe_keys',true)  !='' ){
			
			$keys = @unserialize( get_option('stripe_keys',true));
		}  

		?>	
		
		<div class="ssd_stripe_wrapper">
			<span class="ssd_notification notice form-heading">
				<?php echo ( isset($_REQUEST['stripe_keys']) ) ? 'API Keys Updated.' : ''; ?>
			</span>

			<div class="form-div"> 
				<div class="form-image ssd-stripe-form-content"><img src="<?php echo CNSD_URL."/assets/images/icon-256x256.png"; ?>"></div>
				<h2 class="form-heading"><?php _e('Connect with Stripe & Paypal','cnsd-chartnerd'); ?></h2>
				<div class="ssd_stripe_form ssd-stripe-form-content">
					<form method="post" action="<?php site_url().'/stripe-dashboard/' ?>">
						<div class="ssd_stripe_form_fields">
							<label ><?php _e('Stripe Secret API Key','cnsd-chartnerd') ?> </label>
							<input type="password" id="apikey" name="stripe_keys[apikey]" value="<?php echo isset($keys['apikey']) ? $keys['apikey'] : ''; ?>" />
						</div>
						<div class="ssd_stripe_form_fields">
							<label ><?php _e('Stripe Publishable API Key','cnsd-chartnerd') ?></label>
							<input type="password" id="apiprikey" name="stripe_keys[apiprikey]" value="<?php echo isset($keys['apiprikey']) ? $keys['apiprikey'] : ''; ?>" />
						</div>
						<div class="ssd_stripe_form_fields">
							<label ><?php _e('PayPal API Username','cnsd-chartnerd') ?> </label>
							<input type="password" id="paypal_username" name="stripe_keys[paypal_username]" value="<?php echo isset($keys['paypal_username']) ? $keys['paypal_username'] : ''; ?>" />
						</div>
						<div class="ssd_stripe_form_fields">
							<label ><?php _e('PayPal API password','cnsd-chartnerd') ?> </label>
							<input type="password" id="paypal_passsword" name="stripe_keys[paypal_passsword]" value="<?php echo isset($keys['paypal_passsword']) ? $keys['paypal_passsword'] : ''; ?>" />
						</div>
						<div class="ssd_stripe_form_fields password-field">
							<label ><?php _e('PayPal API Signature Key','cnsd-chartnerd') ?> </label>
							<input type="password" id="paypal_signature" name="stripe_keys[paypal_signature]" value="<?php echo isset($keys['paypal_signature']) ? $keys['paypal_signature'] : ''; ?>" />
						</div>
						<?php wp_nonce_field( 'ssd_stripe_keys_nonce', 'ssd_stripe_keys_nonce_field' ); ?>
						<input type="submit" value="Submit">

					</form>
				</div>
			</div>
			<?php if( isset($keys['apikey']) && '' != ($keys['apikey'])  || isset($keys['paypal_username']) && '' != ($keys['paypal_username']) ) { ?>
				<div class="ssd_stripe_syncr_wrapper">
					<div class="ssd_stripe_syncr_button" style="">
						<div class="synchronise_chardnerd_data_left">
							<input type="submit" value="Synchronise Stripe Data" id="synchronise_stripe_data" />
						</div>
						<?php // if( isset($keys['paypal_username']) && '' != ($keys['paypal_username'])  &&  '' != ($keys['paypal_passsword']) && '' != ($keys['paypal_signature'])){ ?>
							<div class="synchronise_chardnerd_data_right">
								<input type="submit" value="Synchronise Paypal Data" id="synchronise_paypal_data" />
							</div>
							<?php //}	?>

						</div>
						<div class="ssd_notification_stripe_syncr_section">
							<textarea id="ssd_notification_stripe_syncr"  rows="6" cols="50" readonly></textarea>
						</div>
					</div>
				<?php } ?>
			</div>


		<?php  }else{ ?>
			<span class="ssd_notification notice"><?php esc_html_e('Please log in as administrator to access this feature','cnsd-chartnerd'); ?></span> 
		<?php } ?>

	</div> 
	<?php get_footer(); ?>