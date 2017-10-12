<?php

class WebhookController extends Controller
{
    public function Handle()
    {
        $path = '/' . implode('/', $this->Parameters);

        $forwardRule = $this->Models->ForwardRule->Where(array('MatchingPath' => $path, 'IsActive' => 1, 'IsDeleted' => 0))->First();

        if($forwardRule == null){
            return $this->HttpNotFound();
        }

        $body = file_get_contents('php://input');
        $result = $this->TrySendHook($forwardRule, $body);

        $forwardRule->ForwardLogs[] = $this->Models->ForwardLog->Create(array('Payload' => $body, 'Source' => 'test', 'DateTime' => date('yyyy-mm-dd hh:MM:ss'), 'Success' => $result));
        $forwardRule->Save();

        return $this->HttpStatus('204');
    }

    private function TrySendHook($forwardRule, $body)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $forwardRule->ForwardAddress);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, "WebhookForwarder");
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'payload' => $body
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if(!$response){
            return 0;
        }else{
            return 1;
        }
    }
}