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
 * @package    Zend_Service_ShortUrl
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Service_ShortUrl_AbstractShortener
 */
require_once 'Zend/Service/ShortUrl/AbstractShortener.php';

/**
 * Bit.ly API implementation
 *
 * @category   Zend
 * @package    Zend_Service_ShortUrl
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_ShortUrl_BitLy extends Zend_Service_ShortUrl_AbstractShortener
{

    /**
     * Base URI of the service
     *
     * @var string
     */
    protected $_APIUri = 'http://API.bitly.com';

    /**
     * user login name
     *
     * @var string
     */
    protected $_loginName;

    /**
     * user API key or application access token
     *
     * @var string
     */
    protected $_APIKey;

    /**
     * @param string $login user login name or application access token
     * @param null|string $APIKey user API key
     */
    public function __construct($login, $APIKey = null)
    {
        if(null === $APIKey) {
            $this->setOAuthAccessToken($login);
        } else {
            $this->setAPILogin($login, $APIKey);
        }
    }

    /**
     * set OAuth credentials
     *
     * @param $accessToken
     * @return Zend_Service_ShortUrl_BitLy
     */
    public function setOAuthAccessToken($accessToken)
    {
        $this->_APIKey = $accessToken;
        $this->_loginName = null;
        return $this;
    }

    /**
     * set login credentials
     *
     * @param $login
     * @param $APIKey
     * @return Zend_Service_ShortUrl_BitLy
     */
    public function setAPILogin($login, $APIKey)
    {
        $this->_APIKey = $APIKey;
        $this->_loginName = $login;
        return $this;
    }

    /**
     * prepare http client
     * @return void
     */
    protected function _setAccessParameter()
    {
        if(null === $this->_loginName) {
            //OAuth login
            $this->getHttpClient()->setParameterGet('access_token', $this->_APIKey);
        } else {
            //login/APIKey authentication
            $this->getHttpClient()->setParameterGet('login',$this->_loginName);
            $this->getHttpClient()->setParameterGet('APIKey',$this->_APIKey);
        }
    }

    /**
     * handle bit.ly response
     *
     * @return string
     * @throws Zend_Service_ShortUrl_Exception
     */
    protected function _processRequest()
    {
        $response = $this->getHttpClient()->request();
        if(500 == $response->getStatus()) {
            throw new Zend_Service_ShortUrl_Exception('Bit.ly :: '.$response->getBody());
        }
        return $response->getBody();
    }

    /**
     * This function shortens long url
     *
     * @param  string $url URL to Shorten
     * @throws Zend_Service_ShortUrl_Exception if bit.ly reports an error
     * @return string Shortened Url
     */
    public function shorten($url)
    {
        $this->_validateUri($url);
        $this->_setAccessParameter();

        $this->getHttpClient()->setUri($this->_APIUri.'/v3/shorten');
        $this->getHttpClient()->setParameterGet('longUrl',$url);
        $this->getHttpClient()->setParameterGet('format','txt');

        return $this->_processRequest();
    }

    /**
     * Reveals target for short URL
     *
     * @param  string $shortenedUrl URL to reveal target of
     * @throws Zend_Service_ShortUrl_Exception if bit.ly reports an error
     * @return string Unshortened Url
     */
    public function unshorten($shortenedUrl)
    {
        $this->_validateUri($shortenedUrl);
        $this->_setAccessParameter();

        $this->getHttpClient()->setUri($this->_APIUri.'/v3/expand');
        $this->getHttpClient()->setParameterGet('shortUrl',$shortenedUrl);
        $this->getHttpClient()->setParameterGet('format','txt');

        return $this->_processRequest();
    }
}
