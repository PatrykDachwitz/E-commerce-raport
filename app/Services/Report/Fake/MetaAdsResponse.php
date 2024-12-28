<?php
declare(strict_types=1);
namespace App\Services\Report\Fake;

use Illuminate\Support\Facades\Http;

class MetaAdsResponse
{

    private function getJsonResponseMeta(int $click, int $spend) : string {
        return "{
            \"data\":
[
{
\"clicks\":\"$click\",
\"spend\":\"$spend\",
\"date_start\":\"2024-06-21\",
\"date_stop\":\"2024-06-24\"
}
],
\"paging\":
{
\"cursors\":
{
\"before\":\"MAZDZD\",
\"after\":\"MAZDZD\"
}
}
}";
    }
    private function getResponse(int $variant) : string {
        switch ($variant) {
            case 1:
                return $this->getJsonResponseMeta(726, 210);
            case 2:
                return $this->getJsonResponseMeta(792, 200);
            case 3:
                return $this->getJsonResponseMeta(998, 893);
            case 4:
                return $this->getJsonResponseMeta(720, 374);
            case 5:
                return $this->getJsonResponseMeta(123, 362);
            case 6:
                return $this->getJsonResponseMeta(202, 416);
            case 7:
                return $this->getJsonResponseMeta(157, 791);
            case 8:
                return $this->getJsonResponseMeta(106, 191);
            case 9:
                return $this->getJsonResponseMeta(709, 589);
            case 10:
                return $this->getJsonResponseMeta(108, 269);
            case 11:
                return $this->getJsonResponseMeta(117, 196);
            case 12:
                return $this->getJsonResponseMeta(844, 536);
            case 13:
                return $this->getJsonResponseMeta(347, 748);
            case 14:
                return $this->getJsonResponseMeta(849, 227);
            case 15:
                return $this->getJsonResponseMeta(835, 312);
            case 16:
                return $this->getJsonResponseMeta(835, 7851);
            case 17:
                return $this->getJsonResponseMeta(835, 939);
            case 18:
                return $this->getJsonResponseMeta(835, 1987);
            default:
                return $this->getJsonResponseMeta(0, 0);
        }

    }

    public function getSuccessWeekly() : void {
        Http::fake([
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($this->getResponse(1)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($this->getResponse(2)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($this->getResponse(3)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($this->getResponse(4)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response($this->getResponse(5)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($this->getResponse(16)),

            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($this->getResponse(6)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($this->getResponse(7)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($this->getResponse(8)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($this->getResponse(9)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response($this->getResponse(10)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($this->getResponse(17)),

            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-05&time_range%5Buntil%5D=2024-07-07" => Http::response($this->getResponse(11)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-28&time_range%5Buntil%5D=2024-06-30" => Http::response($this->getResponse(12)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-21&time_range%5Buntil%5D=2024-06-23" => Http::response($this->getResponse(13)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-16" => Http::response($this->getResponse(14)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-09" => Http::response($this->getResponse(15)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-07-01&time_range%5Buntil%5D=2024-07-07" => Http::response($this->getResponse(18)),

        ]);
    }
}
