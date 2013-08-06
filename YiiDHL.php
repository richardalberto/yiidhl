<?php

/**
 * YiiDHL class file.
 *
 * @author Richard González Alberto <damnpoet@gmail.com>
 * @link https://github.com/damnpoet/yiidhl
 * @package YiiDHL
 */

/**
 * YiiDHL is a Yii module for faster and easier DHL integration.
 *
 * You may configure it as below.  Check the public attributes and setter
 * methods of this class for more options.
 * <pre>
 * return array(
 * 	...
 * 	'import => array(
 * 		...
 * 		'ext.yiidhl.models.*',
 * 	),
 * 	'components' => array(
 *              'dhl' => array(
 *                   'class' => 'ext.yiidhl.YiiDHL',
 *                   'testMode' => true,
 *                   'useProxy' => true,
 *                   'proxyHost' => 'host:8080',
 *                   'proxyAuth' => 'username:password',
 *              ),
 * 		...
 * 	)
 * );
 * </pre>
 * 
 * Example usage:
 * <pre>
 * $dhlOrderInfo = Yii::app()->dhl->find($trackingNumber);
 * </pre>
 */
class YiiDHL extends CApplicationComponent {

    /**
     * @var bool whether to log messages using Yii::log().
     * Defaults to true.
     */
    public $logging = true;

    /**
     * @var bool whether to use a proxy server.
     * Defaults to false.
     */
    public $useProxy = false;

    /**
     * @var string the proxy host data. Ex. proxy.host.com:8080
     * Defaults to empty
     */
    public $proxyHost = '';

    /**
     * @var string the proxy authentification data. The string should be formated as
     * 'username:password'.
     * Defaults to empty
     */
    public $proxyAuth = '';

    /**
     * @var bool wheter to use test mode or not. Test mode can be used to test your
     * application before going to live mode.
     * Defaults to true
     */
    public $testMode = true;
    
    /**
     * @var string the userId provided by DHL.
     * Defaults to empty
     */
    public $dhlSiteId = 'DServiceVal';
    
    /**
     * @var string the password provided by DHL.
     * Defaults to empty
     */
    public $dhlPassword = 'testServVal';

    /**
     * @var mixed Holds the DHLTracker tracker
     */
    protected $tracker;
    
    /**
     * @var mixed Holds the DHLRequestHandler requestHandler
     */
    protected $requestHandler;
    
    /**
     * @var mixed Holds the DHLCapabilityAndQuoteHandler capabilityAndQuoteHandler
     */
    protected $capabilityAndQuoteHandler;

    /**
     * Calls the {@link registerScripts()} method.
     */
    public function init() {
        parent::init();
    }

    /**
     * Requests a tracking number info from DHL.
     * 
     * The return value is the {@link DHLOrderInfo} returned, or null in case it
     * the number wasn't found.
     * 
     * @param int $trackingNumber
     * @return DHLOrderInfo
     */
    public function find($trackingNumber) {
        if ($this->logging === true)
            self::logTrackingRequest($trackingNumber);

        return $this->getTracker()->single($trackingNumber);
    }
    
    /**
     * Books a new shipping on DHL.
     * 
     * The return value is boolean meaning, booked or not.
     * 
     * @return bool
     */
    public function book() {
        return $this->getRequestHandler()->bookRequest();
    }
    
    /**
     * Query webserver for capability.
     * 
     * The return value is a DHLCapabilityResponse object, or false if nothing returned.
     * 
     * @return DHLCapabilityResponse
     */
    public function getCapabilityResponseForOptions($options = array()) {
        $additionalOptions = array(
            'siteId'=>$this->dhlSiteId,
            'sitePassword'=>$this->dhlPassword,
        );
        
        $options = array_merge($additionalOptions, $options);
        return $this->getCapabilityAndQuoteHandler()->queryCapability($options);
    }

    /**
     * Logs a tracking request using Yii::log.
     * @return string log message
     */
    public static function logTrackingRequest($trackingNumber) {
        $msg = "Tracking number #{$trackingNumber}\n";
        Yii::log($msg, CLogger::LEVEL_INFO, 'ext.yiidhl.YiiDHL');
        return $msg;
    }

    /**
     * Gets the DHLTracker {@link DHLTracker} class instance
     * @return DHLTracker
     */
    public function getTracker() {
        if ($this->tracker === null) {
            $this->tracker = new DHLTracker($this->testMode);
            $this->tracker->setAuth($this->dhlSiteId, $this->dhlPassword);
            if ($this->useProxy)
                $this->tracker->setProxyInfo($this->proxyHost, $this->proxyAuth, true);
        }

        return $this->tracker;
    }
    
    /**
     * Gets the DHLRequestHandler {@link DHLRequestHandler} class instance
     * @return DHLRequestHandler
     */
    public function getRequestHandler() {
        if ($this->requestHandler === null) {
            $this->requestHandler = new DHLRequestHandler($this->testMode);
            $this->requestHandler->setAuth($this->dhlSiteId, $this->dhlPassword);
            if ($this->useProxy)
                $this->requestHandler->setProxyInfo($this->proxyHost, $this->proxyAuth, true);
        }

        return $this->requestHandler;
    }
    
    /**
     * Gets the DHLCapabilityAndQuoteHandler {@link DHLCapabilityAndQuoteHandler} class instance
     * @return DHLCapabilityAndQuoteHandler
     */
    public function getCapabilityAndQuoteHandler() {
        if ($this->capabilityAndQuoteHandler === null) {
            $this->capabilityAndQuoteHandler = new DHLCapabilityAndQuoteHandler($this->testMode);
            $this->capabilityAndQuoteHandler->setAuth($this->dhlSiteId, $this->dhlPassword);
            if ($this->useProxy)
                $this->capabilityAndQuoteHandler->setProxyInfo($this->proxyHost, $this->proxyAuth, true);
        }

        return $this->capabilityAndQuoteHandler;
    }

}