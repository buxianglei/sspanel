<?php
namespace App\Traits;

trait Response {
    
    protected $statusCode, $statusMsg, $data;

    public function getStatusCode()
    {
        return $this->statusCode;
    }
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    public function getStatusMsg()
    {
        return $this->statusMsg;
    }
    public function setStatusMsg($statusMsg)
    {
        $this->statusMsg = $statusMsg;
        return $this;
    }
    public function responseNotFound($data=null, $statusMsg='404 not found')
    {
        $statusCode = 404;
        return $this->response($data, $statusCode, $statusMsg);
    }
    public function responseSuccess($data, $statusMsg='success')
    {
        $statusCode = 200;
        return $this->response($data, $statusCode, $statusMsg);
    }
    public function responseFail($data, $statusMsg="fail")
    {
        $statusCode = 500;
        return $this->response($data, $statusCode, $statusMsg);
    }
    public function responseNotAllow($data, $statusMsg="not allow")
    {
        $statusCode = 403;
        return $this->response($data, $statusCode, $statusMsg);
    }
    private function response($data=null, $statusCode=null, $statusMsg=null)
    {
        return response()->json([
            'status_code' => $statusCode ? $statusCode : $this->statusCode,
            'status_msg' => $statusMsg ? $statusMsg : $this->statusMsg,
            'data' => $data ? $data : $this->data
        ]);
    }
}
