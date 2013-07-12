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
 * 		'yiidhl' => array(
 * 			'class' => 'ext.yiidhl.YiiDHL',
 * 			'testMode' => true,
 *                      'useProxy' => true,
 *                      'proxyHost' => 'host',
 *                      'proxyAuth' => 'username:password'
 * 		),
 * 		...
 * 	)
 * );
 * </pre>
 * 
 * Example usage:
 * <pre>
 * $yiiDHL = new YiiDHL;
 * $orderInfo = $yiiDHL->find($trackingNumber);
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
     * @var mixed Holds the DHLTracker tracker
     */
    protected $tracker;

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
            if ($this->useProxy)
                $this->tracker->setProxyInfo($this->proxyHost, $this->proxyAuth, true);
        }

        return $this->tracker;
    }

}