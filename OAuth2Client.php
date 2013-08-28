<?php
/**
 * simple OAuth2 client for Zendframework
 *
 * https://github.com/datenschleuder/zf-oauth2client
 *
 *
 * @author     Jürgen Meier <support@mypasswordsafe.net>
 * @copyright  Jürgen Meier 2013
 * @version    1.0
 * @license    BSD
 */
final class ZendX_OAuth2Client
{

    private $_httpclient = NULL;

    private $_publickey = NULL;

    private $_secretkey = NULL;

    private $_redirecturl = NULL;

    private $_requestcode = NULL;

    private $_granttype = 'authorization_code';

    private $_refreshtoken = NULL;

    /**
     * set http client
     *
     * @param Zend_Http_Client $httpclient            
     * @return object
     */
    public function setHttpClient (Zend_Http_Client $httpclient)
    {
        $this->_httpclient = (object) $httpclient;
        return $this;
    }

    /**
     * set refresh token
     *
     * @param string $token            
     * @return object
     */
    public function setRefreshToken ($token)
    {
        $this->_refreshtoken = (string) $token;
        return $this;
    }

    /**
     * set grant type
     *
     * @param string $granttype            
     * @return object
     */
    public function setGrantType ($granttype)
    {
        $this->_granttype = (string) $granttype;
        return $this;
    }

    /**
     * set public key
     *
     * @param string $publickey            
     * @return object
     */
    public function setPublicKey ($publickey)
    {
        $this->_publickey = (string) $publickey;
        return $this;
    }

    /**
     * set secret key
     *
     * @param string $secretkey            
     * @return object
     */
    public function setSecretKey ($secretkey)
    {
        $this->_secretkey = (string) $secretkey;
        return $this;
    }

    /**
     * set redirect url
     *
     * @param string $url            
     * @return object
     */
    public function setRedirectUrl ($url)
    {
        $this->_redirecturl = (string) $url;
        return $this;
    }

    /**
     * set request code
     *
     * @param string $code            
     * @return object
     */
    public function setRequestCode ($code)
    {
        $this->_requestcode = (string) $code;
        return $this;
    }

    /**
     * authorize application
     *
     * @return object
     */
    public function authorize ()
    {
        $client = $this->_httpclient;
        $client->setParameterPost('client_id', $this->_publickey);
        $client->setParameterPost('grant_type', $this->_granttype);
        $client->setParameterPost('client_secret', $this->_secretkey);
        $client->setParameterPost('redirect_uri', $this->_redirecturl);
        $client->setParameterPost('code', $this->_requestcode);
        
        return $this;
    }

    /**
     * refresh access token
     *
     * @return object
     */
    public function refresh ()
    {
        $client = $this->_httpclient;
        $client->setParameterPost('client_id', $this->_publickey);
        $client->setParameterPost('grant_type', $this->_granttype);
        $client->setParameterPost('client_secret', $this->_secretkey);
        $client->setParameterPost('refresh_token', $this->_refreshtoken);
        
        return $this;
    }

    /**
     * return access token
     *
     * @return object
     */
    public function getAccessToken ()
    {
        return json_decode(
                $this->_httpclient->request(Zend_Http_Client::POST)->getBody());
    }

    /**
     * return http client
     *
     * @return object | null
     */
    public function getHttpClient ()
    {
        return $this->_httpclient;
    }
}
