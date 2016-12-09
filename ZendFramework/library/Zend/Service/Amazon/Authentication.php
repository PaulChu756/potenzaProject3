<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Service_Amazon
 * @subpackage Authentication
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @category   Zend
 * @package    Zend_Service_Amazon
 * @subpackage Authentication
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Zend_Service_Amazon_Authentication
{
    protected $_accessKey;
    protected $_secretKey;
    protected $_APIVersion;

    /**
     * Constructor
     *
     * @param  string $accessKey
     * @param  string $secretKey
     * @param  string $APIVersion
     * @return void
     */
    public function __construct($accessKey, $secretKey, $APIVersion)
    {
        $this->setAccessKey($accessKey);
        $this->setSecretKey($secretKey);
        $this->setAPIVersion($APIVersion);
    }

    /**
     * Set access key
     *
     * @param  string $accessKey
     * @return void
     */
    public function setAccessKey($accessKey)
    {
        $this->_accessKey = $accessKey;
    }

    /**
     * Set secret key
     *
     * @param  string $secretKey
     * @return void
     */
    public function setSecretKey($secretKey)
    {
        $this->_secretKey = $secretKey;
    }

    /**
     * Set API version
     *
     * @param  string $APIVersion
     * @return void
     */
    public function setAPIVersion($APIVersion)
    {
        $this->_APIVersion = $APIVersion;
    }
}
