<?php
namespace backend\extensions;
use Yii;
/**
 * @author kui
*/
class Curl {
    public $ret = 0;
    public $sub = 0;
    public $msg = 'successfull';
    public $jsonData = '';
    private static $connectTimeout = 30;
    private static $logSize = 5000000;
    const SOCKETTYPE_TCP = 1;
    const SOCKETTYPE_UDP = 2;
    const TYPE_STRING = 1;
    const TYPE_BINARY = 2;
    const DEFAULT_CURL_TIMEOUT = 2;
    /**
     * CURL请求封装函数
     * 若不指定host，这需要传入完整的请求路径，带http://
     *
     * @param string $reqURI
     * @param array $arrayHttpParam
     * @param string $resp
     * @param string $errMsg
     * @param array $server
     * @param int $timeout
     * @param array $extParams
     * @return int 成功 0 没有返回 -1 返回http code不为200 -2
     * @author kui
     */
    private static function CallCURL($reqURI, $arrayHttpParam, &$resp, $server, $timeout = self::DEFAULT_CURL_TIMEOUT) {
        $host = empty($server['ip']) ? '' : $server['ip']; // 服务器端IP
        $port = empty($server['port']) ? '' : $server['port']; // 端口号

        $ch = curl_init();

        foreach ($arrayHttpParam as $key => $value) {
            curl_setopt($ch, $key, $value);
        }

        // 若不指定host，$host需要传入完整的请求路径，带http://
        if (empty($host)) {
            $reqURL = $reqURI;
        } else if (empty($port)) {
            $reqURL = 'http://' . $host . $reqURI;
        } else {
            $reqURL = 'http://' . $host . ':' . $port . $reqURI;
        }

        curl_setopt($ch, CURLOPT_URL, $reqURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $res = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($res == NULL) {
            return -1;
        } else if ($responseCode != "200") {
            return -2;
        }
        $resp = $res;
        return 0;
    }
    /**
     * @author kui
     */
    private static function CallCURLPOST($reqURI, $strHttpParam, &$resp, $server, $timeout = self::DEFAULT_CURL_TIMEOUT) {
        $host = empty($server['ip']) ? '' : $server['ip'];
        $port = empty($server['port']) ? '' : $server['port'];

        $ch = curl_init();

        if ($ch === false) {
            $resp = 'curl_init error';
            return -1;
        }

        // 若不指定host，$host需要传入完整的请求路径，带http://
        if (empty($host)) {
            $reqURL = $reqURI;
        } else if (empty($port)) {
            $reqURL = 'http://' . $host . $reqURI;
        } else {
            $reqURL = 'http://' . $host . ':' . $port . $reqURI;
        }

        curl_setopt($ch, CURLOPT_URL, $reqURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strHttpParam);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $res = curl_exec($ch);
        $response = curl_getinfo($ch);

        if ($res === false) {
            $resp = curl_error($ch) . ' errno = ' . curl_errno($ch) . ' response: ' . str_replace("\n", "", print_r($response, true));
            curl_close($ch);
            return -1;
        }
        $resp = $res;
        curl_close($ch);
        return 0;
    }
    /**
     * @author kui
     */
    public static function buildHttpUrl($host, $postData) {
        $u = $host . (!empty($postData) ? '?' . http_build_query($postData) : '');
        return $u;
    }
    /**
     * @author kui
     */
    public static function http($method, $url, $body = '', $curlopt = array(), $runTime = 30) {
        $resp = '';
        $httpParam = array(
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false);
        if (strtoupper($method) == 'POST') {
            $httpParam[CURLOPT_POST] = true;
            if (!empty($body)) {
                $httpParam[CURLOPT_POSTFIELDS] = $body;
            }
        }

        for ($i = 1; $i <= 3; $i++) {
            $return = self::CallCURL($url, $httpParam, $resp, $curlopt, $runTime);
            if ($return === 0) {
                $json = json_decode($resp, true);
                return $json;
            }
            usleep(200000);
        }
        return false;
    }

    /**
     * URL请求
     * @param string $url 	URL地址
     * @param string $body 	发送的内容
     * @author kui
     */
    public static function urlRequest($url, $data = '', $jsondecode = true) {
        $resp = '';
        $wxapiStartTime = microtime(true);
        $httpParam = array();
        // CURLOPT_SSL_VERIFYPEER => false,
        // CURLOPT_SSL_VERIFYHOST => false,
        // CURLOPT_USERAGENT => 'Weituangou Client',

        if (!empty($data)) {
            $httpParam[CURLOPT_POST] = true;
            $httpParam[CURLOPT_POSTFIELDS] = $jsondecode ? json_decode($data, true) : $data;
        }
        $url = strpos($url, 'http') === 0 ? $url : 'http://' . $_SERVER['HTTP_HOST'] . $url;
        $return = self::CallCURL($url, $httpParam, $resp, array(), self::$connectTimeout);
        switch ($return) {
            case 0:
                $result = 'ok';
                break;
            case -1:
                $result = 'connect error';
                break;
            case -2:
                $result = 'responseCode not 200';
                break;
        }
        if ($return === 0) {
            $json = json_decode($resp, true);
        } else {
            $json = $return;
        }
        return $json;
    }
    
    
    /**
     * for order
     * @todo curl post请求
     */
    public static function curlPost($url, $postdata, &$resp, $timeOut = 10) {
       
        if (!$url) {
            return false;
        }

        if (is_array($postdata)) {
            $postdata = http_build_query($postdata);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $data = curl_exec($ch);

        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        curl_close($ch);
        $resp = json_decode($data, true);
    }
    
}
