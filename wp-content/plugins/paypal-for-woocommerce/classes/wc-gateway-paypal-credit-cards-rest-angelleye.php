<?php

/**
 * WC_Gateway_PayPal_Credit_Card_Rest_AngellEYE class.
 *
 * @extends WC_Payment_Gateway
 */
class WC_Gateway_PayPal_Credit_Card_Rest_AngellEYE extends WC_Payment_Gateway_CC {

    /**
     * Constructor
     */
    protected $paypal_rest_api;
    public $customer_id;
    function __construct() {
        $this->id = 'paypal_credit_card_rest';
        $this->has_fields = true;
        $this->method_title = 'PayPal Credit Card (REST)';
        $this->woocommerce_paypal_supported_currencies = array( 'AUD', 'BRL', 'CAD', 'MXN', 'NZD', 'HKD', 'SGD', 'USD', 'EUR', 'JPY', 'NOK', 'CZK', 'DKK', 'HUF', 'ILS', 'MYR', 'PHP', 'PLN', 'SEK', 'CHF', 'TWD', 'THB', 'GBP' );
        $this->method_description = __('PayPal direct credit card payments using the REST API.  This allows you to accept credit cards directly on the site without the need for the full Payments Pro.', 'paypal-for-woocommerce');
        $this->supports = array(
            'products',
            'refunds'
        );
        $this->init_form_fields();
        $this->init_settings();
        $this->icon = $this->get_option('card_icon', plugins_url('/assets/images/cards.png', plugin_basename(dirname(__FILE__))));
        if (is_ssl()) {
            $this->icon = preg_replace("/^http:/i", "https:", $this->icon);
        }
        $this->icon = apply_filters('woocommerce_paypal_credit_card_rest_icon', $this->icon);
        $this->enable_tokenized_payments = $this->get_option('enable_tokenized_payments', 'no');
        if($this->enable_tokenized_payments == 'yes') {
            array_push($this->supports, "tokenization");
        }
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->testmode = 'yes' === $this->get_option('testmode', 'no');
        $this->mode = $this->testmode == 'yes' ? "SANDBOX" : "LIVE";
        $this->debug = 'yes' === $this->get_option('debug', 'no');
        $this->is_encrypt = $this->get_option('is_encrypt', 'no');
        if ($this->testmode) {
            $this->rest_client_id = $this->get_option('rest_client_id_sandbox', false);
            $this->rest_secret_id = $this->get_option('rest_secret_id_sandbox', false);
        } else {
            $this->rest_client_id = $this->get_option('rest_client_id', false);
            $this->rest_secret_id = $this->get_option('rest_secret_id', false);
        }
        add_action('woocommerce_update_options_payment_gateways', array($this, 'process_admin_options'));
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('admin_notices', array($this, 'checks'));
        add_filter( 'woocommerce_credit_card_form_fields', array($this, 'angelleye_paypal_credit_card_rest_credit_card_form_fields'), 10, 2);
        add_filter('woocommerce_settings_api_sanitized_fields_' . $this->id, array($this, 'angelleye_paypal_credit_card_rest_encrypt_gateway_api'), 10, 1);
        $this->customer_id;
    }

    /**
     * @since    1.2
     */
    public function init_form_fields() {
        $this->form_fields = AngellEYE_Utility::angelleye_paypal_credit_card_rest_setting_fields();
    }

    /**
     * @since    1.2
     */
    public function admin_options() {
        if ($this->is_valid_for_use_paypal_credit_card_rest()) {
            ?>
            <h3><?php echo (!empty($this->method_title) ) ? $this->method_title : __('Settings', 'paypal-for-woocommerce'); ?></h3>
            <?php echo (!empty($this->method_description) ) ? wpautop($this->method_description) : ''; ?>
            <table class="form-table">
                <?php $this->generate_settings_html(); ?>
            </table>
            <script type="text/javascript">
                jQuery('#woocommerce_paypal_credit_card_rest_testmode').change(function () {
                    var sandbox = jQuery('#woocommerce_paypal_credit_card_rest_rest_client_id_sandbox, #woocommerce_paypal_credit_card_rest_rest_secret_id_sandbox').closest('tr'),
                            production = jQuery('#woocommerce_paypal_credit_card_rest_rest_client_id, #woocommerce_paypal_credit_card_rest_rest_secret_id').closest('tr');
                    if (jQuery(this).is(':checked')) {
                        sandbox.show();
                        production.hide();
                    } else {
                        sandbox.hide();
                        production.show();
                    }
                }).change();
            </script><?php
            } else {
                ?><div class="inline error"><p><strong><?php _e('Gateway Disabled', 'paypal-for-woocommerce'); ?></strong>: <?php _e('PayPal does not support your store currency.', 'paypal-for-woocommerce'); ?></p></div> <?php
        }
    }

    /**
     * @since    1.2
     * Check if SSL is enabled and notify the user
     */
    public function checks() {
        $this->add_rest_api_utility();
        if ($this->enabled == 'no') {
            return;
        }
        $this->paypal_rest_api->add_dependencies_admin_notices();
    }

    /**
     * @since    1.2
     * @return boolean
     */
    public function is_available() {
        if ($this->enabled === "yes") {
            if (!$this->rest_client_id || !$this->rest_secret_id) {
                return false;
            }
            if (!in_array(get_woocommerce_currency(), apply_filters('woocommerce_paypal_rest_api_supported_currencies', $this->woocommerce_paypal_supported_currencies))) {
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * @since    1.2
     */
    public function payment_fields() {
        if ($this->description) {
            echo wpautop(wptexturize($this->description));
        }
        parent::payment_fields();
        do_action('payment_fields_saved_payment_methods', $this);
    }

    /**
     * @since    1.2
     * @return type
     */
    public function is_valid_for_use_paypal_credit_card_rest() {
        return in_array(get_woocommerce_currency(), apply_filters('woocommerce_paypal_rest_api_supported_currencies', $this->woocommerce_paypal_supported_currencies));
    }

    /**
     * @since    1.2
     * @return boolean
     * @throws Exception
     */
    public function validate_fields() {
        $this->add_rest_api_utility();
        try {
            if ( isset( $_POST['wc-paypal_credit_card_rest-payment-token'] ) && 'new' !== $_POST['wc-paypal_credit_card_rest-payment-token'] ) {
                $token_id = wc_clean( $_POST['wc-paypal_credit_card_rest-payment-token'] );
                $token  = WC_Payment_Tokens::get( $token_id );
                if ( $token->get_user_id() !== get_current_user_id() ) {
                    throw new Exception(__('Error processing checkout. Please try again.', 'paypal-for-woocommerce'));
                }else {
                    return true;
                }
            }
            $card = $this->paypal_rest_api->get_posted_card();
            if (empty($card->exp_month) || empty($card->exp_year)) {
                throw new Exception(__('Card expiration date is invalid', 'woocommerce-gateway-paypal-pro'));
            }
            if (!ctype_digit($card->cvc)) {
                throw new Exception(__('Card security code is invalid (only digits are allowed)', 'woocommerce-gateway-paypal-pro'));
            }
            if (!ctype_digit($card->exp_month) || !ctype_digit($card->exp_year) || $card->exp_month > 12 || $card->exp_month < 1 || $card->exp_year < date('y')) {
                throw new Exception(__('Card expiration date is invalid', 'woocommerce-gateway-paypal-pro'));
            }
            if (empty($card->number) || !ctype_digit($card->number)) {
                throw new Exception(__('Card number is invalid', 'woocommerce-gateway-paypal-pro'));
            }
            return true;
        } catch (Exception $e) {
            wc_add_notice($e->getMessage(), 'error');
            return false;
        }
    }

    /**
     * @since    1.2
     * Process the payment
     */
    public function process_payment($order_id) {
        $this->add_rest_api_utility();
        $order = wc_get_order($order_id);
        $card = $this->paypal_rest_api->get_posted_card();
        return $this->do_payment($order, $card);
    }

    /**
     * @since    1.2
     * @param type $order
     * @param type $card
     */
    public function do_payment($order, $card) {
        $this->add_rest_api_utility();
        $this->paypal_rest_api->create_payment($order, $card);
    }

    /**
     * @since    1.2
     * @param type $order_id
     * @param type $amount
     * @param type $reason
     * @return type
     */
    public function process_refund($order_id, $amount = null, $reason = '') {
        $this->add_rest_api_utility();
        $return = $this->paypal_rest_api->payment_refund($order_id, $amount, $reason);
        if ($return) {
            return $return;
        }
    }

    /**
     * @since    1.2
     */
    public function add_rest_api_utility() {
        if (empty($this->paypal_rest_api)) {
            if (class_exists('PayPal_Rest_API_Utility')) {
                $this->paypal_rest_api = new PayPal_Rest_API_Utility();
            } else {
                include_once ( PAYPAL_FOR_WOOCOMMERCE_PLUGIN_DIR . '/angelleye-includes/paypal-rest-api-utility.php' );
                $this->paypal_rest_api = new PayPal_Rest_API_Utility();
            }
        }
    }
        
    public function get_transaction_url( $order ) {
        $sandbox_transaction_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_view-a-trans&id=%s';
        $live_transaction_url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_view-a-trans&id=%s';
        $is_sandbox = get_post_meta($order->id, 'is_sandbox', true);
        if ( $is_sandbox  == true ) {
            $this->view_transaction_url = $sandbox_transaction_url;
        } else {
            if ( empty( $is_sandbox ) ) {
                if (  $this->mode == 'SANDBOX' ) {
                    $this->view_transaction_url = $sandbox_transaction_url;
                } else {
                    $this->view_transaction_url = $live_transaction_url;
                }
            } else {
                $this->view_transaction_url = $live_transaction_url;
            }
        }
        return parent::get_transaction_url( $order );
    }
    public function field_name( $name ) {
	return ' name="' . esc_attr( $this->id . '-' . $name ) . '" ';
    }
    public function angelleye_paypal_credit_card_rest_credit_card_form_fields($default_fields, $current_gateway_id) {
        if($current_gateway_id == $this->id) {
		$fields = array(
                    'card-number-field' => '<p class="form-row form-row-wide">
                        <label for="' . esc_attr( $this->id ) . '-card-number">' . __( 'Card number', 'woocommerce' ) . ' <span class="required">*</span></label>
                        <input id="' . esc_attr( $this->id ) . '-card-number" class="input-text wc-credit-card-form-card-number" inputmode="numeric" autocomplete="cc-number" autocorrect="no" autocapitalize="no" spellcheck="no" type="tel" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" ' . $this->field_name( 'card-number' ) . ' />
                    </p>',
                    'card-expiry-field' => '<p class="form-row form-row-first">
                        <label for="' . esc_attr( $this->id ) . '-card-expiry">' . __( 'Expiry (MM/YY)', 'woocommerce' ) . ' <span class="required">*</span></label>
                        <input id="' . esc_attr( $this->id ) . '-card-expiry" class="input-text wc-credit-card-form-card-expiry" inputmode="numeric" autocomplete="cc-exp" autocorrect="no" autocapitalize="no" spellcheck="no" type="tel" placeholder="' . esc_attr__( 'MM / YY', 'woocommerce' ) . '" ' . $this->field_name( 'card-expiry' ) . ' />
                    </p>',
                    '<p class="form-row form-row-last">
                        <label for="' . esc_attr( $this->id ) . '-card-cvc">' . __( 'Card code', 'woocommerce' ) . ' <span class="required">*</span></label>
                        <input id="' . esc_attr( $this->id ) . '-card-cvc" class="input-text wc-credit-card-form-card-cvc" inputmode="numeric" autocomplete="off" autocorrect="no" autocapitalize="no" spellcheck="no" type="tel" maxlength="4" placeholder="' . esc_attr__( 'CVC', 'woocommerce' ) . '" ' . $this->field_name( 'card-cvc' ) . ' style="width:100px" />
                    </p>'
		);
                return $fields;
        } else {
            return $default_fields;
        }
    }
    
    public function add_payment_method() {
        $this->add_rest_api_utility();
        $card = $this->paypal_rest_api->get_posted_card();
        $result = $this->paypal_rest_api->save_credit_card($card);
        return $result;
    }
    
    public function angelleye_paypal_credit_card_rest_encrypt_gateway_api($settings) {
        if( !empty($settings['is_encrypt']) ) {
            $gateway_settings_key_array = array('rest_client_id_sandbox', 'rest_secret_id_sandbox', 'rest_client_id', 'rest_secret_id');
            foreach ($gateway_settings_key_array as $gateway_settings_key => $gateway_settings_value) {
                if( !empty( $settings[$gateway_settings_value]) ) {
                    $settings[$gateway_settings_value] = AngellEYE_Utility::crypting($settings[$gateway_settings_value], $action = 'e');
                }
            }
        }
        return $settings;
    }
}