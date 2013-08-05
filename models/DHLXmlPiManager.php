<?php

abstract class DHLXmlPiManager {
    const PI_URL = 'https://xmlpi-ea.dhl.com/XMLShippingServlet';
    const PI_URL_TEST = 'https://xmlpitest-ea.dhl.com/XMLShippingServlet';

    const STATUS_FAILURE = 'Failure';
    const STATUS_NO_SHIPMENT_FOUND = 'No Shipments Found';

    /**
     * @var bool whether to use the live or test url.
     * Defaults to true
     */
    var $inTestMode;

    /**
     * @var string the siteId provided by DHL, this is used in live mode.
     * Defaults to 'DServiceVal'
     */
    var $siteId = "DServiceVal";

    /**
     * @var string the password provided by DHL, this is used in live mode.
     * Defaults to 'testServVal'
     */
    var $passwd = "testServVal";

    /**
     * @var bool if a proxy server will be used to connect with DHL.
     * Defaults to false
     */
    public $useProxy = false;

    /**
     * @var string the auth string. Format: 'username:password'
     * Defaults to false
     */
    public $proxyAuth = false;

    /**
     * @var string the host address. 
     * Format: 'host:port' 
     * Example: proxy.host.com:80 
     * Defaults to false
     */
    public $proxyHost = false;
    
    
    var $_errors = array();
    var $errorFail = false;
    
    var $_xml = null;
    var $_result = null;
    var $_xmlEnd = "\n"; 

    function __construct($inTestMode = true) {
        $this->inTestMode = $inTestMode;
    }

    public function setAuth($siteId = NULL, $passwd = NULL) {
        $this->siteId = $siteId;
        $this->passwd = $passwd;
    }

    public function setProxyInfo($proxy, $proxyAuth, $use = true) {
        $this->useProxy = $use;
        $this->proxyHost = $proxy;
        $this->proxyAuth = $proxyAuth;
    }

    public function getErrors() {
        return ($this->_errors);
    }

    protected function logError($loc = "", $msg = "", $fail = false) {
        //
        $tmp = array(
            'location' => $loc,
            'message' => $msg,
            'stop' => ((bool) $fail ? "Yes" : "No"),
            'time' => microtime(true)
        );
        if ((bool) $fail) {
            $this->errorFail = true;
        }
        $this->_errors[] = $tmp;
        $tmp = NULL;
    }

    protected function sendCallPI() {
        if (!$ch = curl_init()) {
            $this->logError("Send >> Curl", $msg = "Curl is not initialized", true);
            return false;
        } else {
            if (!$this->errorFail) {
                $use_url = ($this->inTestMode ? DHLTracker::PI_URL_TEST : DHLTracker::PI_URL);
                curl_setopt($ch, CURLOPT_URL, $use_url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_xml);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                if ($this->useProxy) {
                    curl_setopt($ch, CURLOPT_PROXY, $this->proxyHost);
                    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxyAuth);
                }
                $this->_result = curl_exec($ch);
                if (curl_error($ch) != "") {
                    $this->logError("Send >> Curl", $msg = "Error with Curl installation: " . curl_error($ch), true);
                    return false;
                } else {
                    curl_close($ch);
                    return $this->_result;
                }
            }
        }
    }

    protected function retrieveXmlFromView($view, $params = array()) {
        // if Yii::app()->controller doesn't exist create a dummy 
        // controller to render the view (needed in the console app)
        if (isset(Yii::app()->controller))
            $controller = Yii::app()->controller;
        else
            $controller = new CController('YiiDHL');

        // renderPartial won't work with CConsoleApplication, so use 
        // renderInternal - this requires that we use an actual path to the 
        // view rather than the usual alias
        $viewPath = Yii::getPathOfAlias('ext.yiidhl.views.' . $view) . '.php';
        return $controller->renderInternal($viewPath, $params, true);
    }

}