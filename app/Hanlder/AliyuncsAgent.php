<?php

namespace App\Hanlder;

use Carbon\Carbon;
use Toplan\PhpSms\Agent;

/**
 * Class ChangZhuoAgent
 *
 * @property string $account
 */
class AliyuncsAgent extends Agent
{
    public function sendSms($to, $content, $tempData, array $data)
    {
        $this->sendTemplateSms($to, $tempData, $data);
    }

    public function sendTemplateSms($to, $tempData, array $data)
    {
        $params = [
            // 公共参数
            'Format' => $this->format,
            'Version' => $this->version,
            'AccessKeyId' => $this->accessKeyID,
            'SignatureVersion' => $this->signatureVersion,
            'SignatureMethod' => $this->signatureMethod,
            'SignatureNonce'=> uniqid(),
            'Timestamp' => Carbon::now('UTC')->format('Y-m-d\TH:i:s\Z'),
            'RegionId' => 'cn-hangzhou',
            // 接口参数
            'Action' => 'SingleSendSms',
            'SignName' => $tempData['signName'],
            'ParamString' => $this->getTempDataString($data),
            'RecNum' => $this->recNum($to),
            'TemplateCode' => $tempData['templateCode'],
        ];

        $url = 'https://sms.aliyuncs.com/';
        $params['Signature'] = $this->computeSignature($params, $this->accessKeySecret);
        $params = http_build_query($params);
        $response = $this->sockPost($url, $params);
        $this->setResult($response);
    }

    protected function getTempDataString(array $data)
    {
        $data = array_map(function ($value) {
            return (string) $value;
        }, $data);

        return json_encode($data);
    }

    public function sendContentSms($to, $content)
    {
    }

    public function voiceVerify($to, $code, $tempId, array $data)
    {
    }

    public function percentEncode($str)
    {
        // 使用urlencode编码后，将"+","*","%7E"做替换即满足ECS API规定的编码规范
        $res = urlencode($str);
        $res = preg_replace('/\+/', '%20', $res);
        $res = preg_replace('/\*/', '%2A', $res);
        $res = preg_replace('/%7E/', '~', $res);
        return $res;
    }

    public function computeSignature($parameters, $accessKeySecret)
    {
        // 将参数Key按字典顺序排序
        ksort($parameters);
        // 生成规范化请求字符串
        $canonicalizedQueryString = '';
        foreach ($parameters as $key => $value) {
            $canonicalizedQueryString .= '&' . $this->percentEncode($key)
            . '=' . $this->percentEncode($value);
        }
        // 生成用于计算签名的字符串 stringToSign
        $stringToSign = 'POST&%2F&' . $this->percentencode(substr($canonicalizedQueryString, 1));
        // 计算签名，注意accessKeySecret后面要加上字符'&'
        $signature = base64_encode(hash_hmac('sha1', $stringToSign, $accessKeySecret . '&', true));
        return $signature;
    }

    public function recNum($data)
    {
        if (is_array($data)) {
            $data = implode(',', $data);
        }
        return $data;
    }

    protected function setResult($result)
    {
        $result =json_decode($result, true);
        if (isset($result['Message'])) {
            $this->result(Agent::INFO, '请求失败');
        } else {
            $this->result(Agent::INFO, $result);
            $this->result(Agent::SUCCESS, (bool) $result);
            $this->result(Agent::CODE, 0);
        }
    }
}
