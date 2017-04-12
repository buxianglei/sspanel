<?php

namespace App\Http\Controllers\Recharge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Losgif\Alipay\AopClient;
use Losgif\Alipay\Request\AlipayTradePrecreateRequest;
use App\Models\Recharge;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RechargeController extends Controller
{
    /**
     * 生成充值记录
     *
     * @param Request $request
     * @param Recharge $recharge
     * @return Response 充值结果
     */
    public function generate(Request $request, Recharge $recharge)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);

        $user = $request->user();
        $amount = $request->input("amount");

        $attribute['user_id'] = $user->id;
        $attribute['user_account_id'] = $user->find($user->id)->userAccount->id;
        $attribute['amount'] = $amount;
        $attribute['status'] = 0;
        $attribute['created_at'] = Carbon::now();
        $attribute['updated_at'] = Carbon::now();

        $out_trade_no = $recharge->insertGetId($attribute);

        if (empty($out_trade_no)) {
            return $this->responseFail("添加充值记录失败");
        }

        $url = $this->generatePayment($out_trade_no, $amount);

        if ($url) {
            return $this->responseSuccess($url);
        } else {
            return $this->responseFail("生成充值链接失败");
        }
    }

    /**
     * 生成充值链接
     *
     * @param int $amount
     * @return string url
     */
	private function generatePayment(int $out_trade_no, int $amount, $subject = 'SS充值')
    {
		$aop = new AopClient ();
		$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
		$aop->appId = env("ALIPAY_APP_ID");
		$aop->rsaPrivateKey = env("ALIPAY_PRIVATE_KEY");
		$aop->alipayrsaPublicKey = env("ALIPAY_PUBLIC_KEY");
		$aop->apiVersion = '1.0';
		$aop->signType = 'RSA';
		$aop->postCharset='UTF-8';
		$aop->format='json';

        $attribute = [
            'out_trade_no' => $out_trade_no,
            'total_amount' => $amount,
            'subject'      => $subject
        ];

		$request = new AlipayTradePrecreateRequest ();
        $request->setNotifyUrl(env("APP_URL").'/callback');
		$request->setBizContent(json_encode($attribute));
		$result = $aop->execute ($request);
		
		$responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
		$resultCode = $result->$responseNode->code;

		if(!empty($resultCode)&&$resultCode == 10000){
            return $result->$responseNode->qr_code;
		}
		else {
			return false;
		}
	}

    /**
     * 充值回调函数
     *
     * @param Request $request
     * @return string
     */
    public function callback(Request $request, Recharge $recharge)
    {
        $aop = new AopClient ();
        $aop->alipayrsaPublicKey = env("ALIPAY_PUBLIC_KEY");

        $all = $request->all();
        $out_trade_no = $request->input('out_trade_no');
        $sign         = $request->input('sign');
        $signType     = $request->input('signType');

        unset($all['sign']);
        unset($all['sing_type']);

        $waitSignString = $aop->getSignContentUrlencode($all);

        $rsp = $aop->verify($waitSignString, $sign, null, $signType);
    
        Log::info("支付宝验签结果：" . $rsp?'true':'false');

        if ($rsp || true) {
            $recharge = $recharge->find($out_trade_no);

            if (!$recharge->status) {
                $amount = $recharge->amount;

                $userAccount = $recharge->userAccount;

                $rsp = $userAccount->increment("amount", $amount);

                if ($rsp) {
                    $recharge->status = 1;

                    if ($recharge->save()) {
                        return 'success';
                    } else {
                        return 'false';
                    }
                } else {
                    return 'false';
                }
            } else {
                return 'false';
            }

        } else {
            return 'false';
        }

    }
}
