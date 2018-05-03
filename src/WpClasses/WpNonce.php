<?php
namespace WpClasses;

require_once __DIR__ . '/../../wp/wp-load.php';

class WpNonce {
    private $nonce;
    private $action;
    private $fields;
    private $url;

    public function __construct ($action = null) {
      if (! empty($action)){
        $this->nonceCreate($action);
      }
    }
    /**
     * Wordpress function reference: wp_create_nonce
     *
     * Creates a cryptographic token tied to a specific action, user, and window of time.
     *
     * @param string|int $action Scalar value to add context to the nonce. Action is saved in 'action' property. Token is saved in 'nonce' property.
     */
    public function nonceCreate($action){
      $this->action = $action;
      $this->nonce = wp_create_nonce($this->action);
    }
    /**
     * Wordpress function reference: wp_nonce_ays
     *
     * Display "Are You Sure" message to confirm the action being taken.
     *
     * If the action has the nonce explain message, then it will be displayed
     * along with the "Are you sure?" message.
     */
    public function nonceAys(){
      wp_nonce_ays($this->action);
    }
    /**
     * Wordpress function reference: wp_nonce_field
     *
     * Retrieve or display nonce hidden field for forms.
     *
     * @param string     $name    Optional. Nonce name. Default '_wpnonce'.
     * @param bool       $referer Optional. Whether to set the referer field for validation. Default true.
     * @param bool       $echo    Optional. Whether to display or return hidden form field. Default true.
     *
     * Fields are saved in 'fields' property.
     */
    public function nonceField($name = "_wpnonce", $referer = true , $echo = true){
      $this->fields = wp_nonce_field($this->action, $name, $referer, $echo);
    }
    /**
     * Retrieve URL with nonce added to URL query.
     *
     * @param string     $actionurl URL to add nonce action.
     * @param string     $name      Optional. Nonce name. Default '_wpnonce'.
     *
     * Url is saved in 'url' property.
     */
    public function nonceUrl($actionurl, $name = '_wpnonce'){
      $this->url = wp_nonce_url($actionurl, $this->action, $name);
    }
    /**
     * Wordpress function reference: wp_verify_nonce
     *
     * Verify that correct nonce was used with time limit.
     *
     * @param string     $nonce  Nonce that was used in the form to verify
     * @return false|int False if the nonce is invalid, 1 if the nonce is valid and generated between
     *                   0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
     */
    public function nonceVerify($nonce){
      return wp_verify_nonce($nonce, $this->action);
    }

    public function getNonce(){
      return $this->nonce;
    }
    public function getAction(){
      return $this->action;
    }
    public function getFields(){
      return $this->fields;
    }
    public function getUrl(){
      return $this->url;
    }
}

?>
