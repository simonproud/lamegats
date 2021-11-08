<?php

namespace SimonProud\Lamegats\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use SimonProud\Lamegats\Facades\Lamegats;
use SimonProud\Lamegats\Models\Account;
use SimonProud\Lamegats\Models\Call;
use Carbon\Carbon;

class CallController  extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $calls = (new Call());
        if(isset($request->call_id)){
            $calls = $calls->where('call_id', '=', $request->call_id);
        }
        if(isset($request->client_type)){
           $clientTypes = config('vats.clients');
           if(key_exists($request->client_type , $clientTypes)){
               $calls = $calls->where('client_type', '=', $clientTypes[$request->client_type]);
           }
        }
        if(isset($request->client_id)){
            $calls = $calls->where('client_id', '=', $request->client_id);
        }
        if(isset($request->duration_from)){
            $calls = $calls->where('duration', '>=', $request->duration_from);
        }
        if(isset($request->duration_to)){
            $calls = $calls->where('duration', '<', $request->duration_from);
        }
        if(isset($request->status)){
            $calls = $calls->where('status', '=', $request->status);
        }
        if(isset($request->from)){
            $calls = $calls->where('start', '>=', Carbon::parse($request->from));
        }
        if(isset($request->to)){
            $calls = $calls->where('start', '<', Carbon::parse($request->to));
        }

        if(isset($request->account_id)){
            $calls = $calls->where('account_id', '=', $request->account_id);
        }
        if(isset($request->phone)){
            $calls = $calls->where('phone', '=', $request->phone);
        }

        return $this->sendResponse($calls->paginate(), 'success query');
    }

    public function store(){
        throw new \Exception('Method not allowed from here');
    }

    public function show(Call $call){
        try {
            return $this->sendResponse($call, 'success query');
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage(), $exception->getTrace());
        }
    }

    /**
     * @throws \Exception
     */
    public function makeCall(Account $account, Request $request){
        try {
            $pattern = "^\D*(?:\d\D*){10,}$";
            $phone = preg_replace($pattern, "", $request->phone);
            $account->makeCall($phone);
            return $this->sendResponse('request sended', 'success query');
        }catch (\Exception $exception){
            return $this->sendError($exception->getMessage(), $exception->getTrace());
        }
    }


}