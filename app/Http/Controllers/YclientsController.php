<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Integrations\Yclients\YclientsManager;
use App\Classes\Integrations\Yclients\YclientsDataValidation;

class YclientsController extends Controller
{
    public function webhook(Request $request)
    {
        $validation = new YclientsDataValidation;
        if (!$validation->validation($request)) {
            return;
        }

//        dd($request->all());
//        {"company_id":358944,"resource":"record","resource_id":234961815,"status":"update","data":{"id":234961815,"company_id":358944,"staff_id":1072559,"services":[{"id":6137968,"title":"\u041e\u043a\u0440\u0430\u0448\u0438\u0432\u0430\u043d\u0438\u0435 2 (\u0434\u043e 120 \u0433\u0440 \u043a\u0440\u0430\u0441\u0438\u0442\u0435\u043b\u044f) (\u0421\u0442\u0438\u043b\u0438\u0441\u0442)","cost":5900,"manual_cost":5900,"cost_per_unit":8900,"discount":33.710000000000001,"first_cost":8900,"amount":1}],"goods_transactions":[],"staff":{"id":1072559,"api_id":null,"name":"\u0413\u0435\u0440\u0430\u0441\u0438\u043c\u043e\u0432\u0430 \u041b\u0430\u0440\u0438\u0441\u0430","specialization":"\u0421\u0442\u0438\u043b\u0438\u0441\u0442","position":{"id":136429,"title":"\u0421\u0442\u0438\u043b\u0438\u0441\u0442"},"avatar":"https:\/\/assets.yclients.com\/masters\/sm\/b\/ba\/badac286451ab5f_20200915141630.png","avatar_big":"https:\/\/assets.yclients.com\/masters\/origin\/1\/15\/15dff019686fc3a_20200915141631.png","rating":5,"votes_count":0},"client":{"id":86694283,"name":"\u041e\u043b\u0435\u0441\u044f","phone":"+79999856814","card":"","email":"","success_visits_count":1,"fail_visits_count":0,"discount":0},"comer":null,"clients_count":1,"date":"2020-11-21 16:00:00","datetime":"2020-11-21T16:00:00+03:00","create_date":"2020-10-29T13:34:26+0300","comment":"\u0441\u043a\u0438\u0434\u043a\u0430 \u043f\u043e \u043a\u0432\u0438\u0437 3000 \u0440\u0443\u0431\u043b\u0435\u0439","online":false,"visit_attendance":0,"attendance":0,"confirmed":1,"seance_length":8100,"length":8100,"sms_before":0,"sms_now":0,"sms_now_text":"","email_now":1,"notified":0,"master_request":1,"api_id":"","from_url":"","review_requested":0,"visit_id":198814560,"created_user_id":8490747,"deleted":false,"paid_full":0,"prepaid":false,"prepaid_confirmed":false,"last_change_date":"2020-11-17T13:58:19+0300","custom_color":"","custom_font_color":"","record_labels":[{"id":2678328,"title":"\u0417\u0430\u043f\u0438\u0441\u044c \u041c\u041f\u041f","color":"dfd4f2","icon":"skype","font_color":"000000"},{"id":2495555,"title":"\u0421\u043e\u0442\u0440\u0443\u0434\u043d\u0438\u043a \u0432\u0430\u0436\u0435\u043d","color":"ff2828","icon":"lock","font_color":"ffffff"},{"id":2678365,"title":"\u041d\u043e\u0432\u044b\u0439 \u043a\u043b\u0438\u0435\u043d\u0442","color":"dfd4f2","icon":"exclamation","font_color":"000000"}],"activity_id":0,"custom_fields":{"salesap_id":1786534},"documents":[{"id":270825957,"type_id":7,"storage_id":0,"user_id":8490747,"company_id":358944,"number":4860,"comment":"","date_created":"2020-11-21 15:00:00","category_id":0,"visit_id":198814560,"record_id":234961815,"type_title":"\u0412\u0438\u0437\u0438\u0442"}]}}

        $yclientsManager = new YclientsManager($request->all());
        $yclientsManager->handle();
    }
}
