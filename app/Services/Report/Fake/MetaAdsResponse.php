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

    public function getSuccessDay() : void {
        Http::fake([
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($this->getJsonResponseMeta(5393, 420)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($this->getJsonResponseMeta(2021, 548)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($this->getJsonResponseMeta(9205, 345)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($this->getJsonResponseMeta(349, 450)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($this->getJsonResponseMeta(3640, 283)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($this->getJsonResponseMeta(1056, 587)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($this->getJsonResponseMeta(3311, 717)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($this->getJsonResponseMeta(1958, 271)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($this->getJsonResponseMeta(8858, 876)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($this->getJsonResponseMeta(1727, 861)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($this->getJsonResponseMeta(348, 548)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($this->getJsonResponseMeta(6495, 327)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($this->getJsonResponseMeta(7823, 784)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($this->getJsonResponseMeta(6010, 846)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($this->getJsonResponseMeta(2439, 342)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($this->getJsonResponseMeta(5004, 557)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($this->getJsonResponseMeta(5272, 460)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($this->getJsonResponseMeta(5930, 920)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($this->getJsonResponseMeta(5603, 309)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($this->getJsonResponseMeta(3497, 888)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($this->getJsonResponseMeta(4829, 106)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($this->getJsonResponseMeta(9980, 465)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($this->getJsonResponseMeta(2019, 590)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($this->getJsonResponseMeta(2232, 846)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($this->getJsonResponseMeta(7690, 615)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($this->getJsonResponseMeta(6225, 245)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($this->getJsonResponseMeta(1033, 144)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($this->getJsonResponseMeta(6013, 450)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($this->getJsonResponseMeta(4339, 524)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($this->getJsonResponseMeta(9872, 706)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-21&time_range%5Buntil%5D=2024-05-21" => Http::response($this->getJsonResponseMeta(5690, 725)),
            "https://graph.facebook.com/v20.0/act_123123123/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-20" => Http::response($this->getJsonResponseMeta(85939, 11339)),

            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($this->getJsonResponseMeta(7912, 644)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($this->getJsonResponseMeta(1394, 79)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($this->getJsonResponseMeta(1636, 11)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($this->getJsonResponseMeta(6847, 144)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($this->getJsonResponseMeta(2460, 221)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($this->getJsonResponseMeta(6029, 735)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($this->getJsonResponseMeta(8417, 371)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($this->getJsonResponseMeta(5131, 964)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($this->getJsonResponseMeta(9759, 182)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($this->getJsonResponseMeta(7002, 723)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($this->getJsonResponseMeta(3948, 185)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($this->getJsonResponseMeta(1454, 645)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($this->getJsonResponseMeta(2154, 894)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($this->getJsonResponseMeta(6238, 283)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($this->getJsonResponseMeta(8256, 367)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($this->getJsonResponseMeta(520, 891)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($this->getJsonResponseMeta(8686, 480)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($this->getJsonResponseMeta(7500, 312)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($this->getJsonResponseMeta(7087, 738)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($this->getJsonResponseMeta(492, 521)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($this->getJsonResponseMeta(1010, 455)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($this->getJsonResponseMeta(7207, 495)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($this->getJsonResponseMeta(2302, 871)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($this->getJsonResponseMeta(5831, 905)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($this->getJsonResponseMeta(9390, 22)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($this->getJsonResponseMeta(7685, 993)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($this->getJsonResponseMeta(8426, 665)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($this->getJsonResponseMeta(9623, 148)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($this->getJsonResponseMeta(3706, 928)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($this->getJsonResponseMeta(2749, 669)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-21&time_range%5Buntil%5D=2024-05-21" => Http::response($this->getJsonResponseMeta(2641, 689)),
            "https://graph.facebook.com/v20.0/act_123123126/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-20" => Http::response($this->getJsonResponseMeta(102922, 9390)),

            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-20&time_range%5Buntil%5D=2024-06-20" => Http::response($this->getJsonResponseMeta(8651, 150)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-19&time_range%5Buntil%5D=2024-06-19" => Http::response($this->getJsonResponseMeta(6507, 301)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-18&time_range%5Buntil%5D=2024-06-18" => Http::response($this->getJsonResponseMeta(7052, 127)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-17&time_range%5Buntil%5D=2024-06-17" => Http::response($this->getJsonResponseMeta(371, 814)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-16&time_range%5Buntil%5D=2024-06-16" => Http::response($this->getJsonResponseMeta(2074, 997)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-15&time_range%5Buntil%5D=2024-06-15" => Http::response($this->getJsonResponseMeta(4641, 530)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-14&time_range%5Buntil%5D=2024-06-14" => Http::response($this->getJsonResponseMeta(5131, 938)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-13&time_range%5Buntil%5D=2024-06-13" => Http::response($this->getJsonResponseMeta(5298, 671)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-12&time_range%5Buntil%5D=2024-06-12" => Http::response($this->getJsonResponseMeta(3209, 48)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-11&time_range%5Buntil%5D=2024-06-11" => Http::response($this->getJsonResponseMeta(6381, 216)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-10&time_range%5Buntil%5D=2024-06-10" => Http::response($this->getJsonResponseMeta(410, 679)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-09&time_range%5Buntil%5D=2024-06-09" => Http::response($this->getJsonResponseMeta(6546, 442)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-08&time_range%5Buntil%5D=2024-06-08" => Http::response($this->getJsonResponseMeta(5524, 353)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-07&time_range%5Buntil%5D=2024-06-07" => Http::response($this->getJsonResponseMeta(6163, 149)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-06&time_range%5Buntil%5D=2024-06-06" => Http::response($this->getJsonResponseMeta(9354, 850)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-05&time_range%5Buntil%5D=2024-06-05" => Http::response($this->getJsonResponseMeta(5268, 541)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-04&time_range%5Buntil%5D=2024-06-04" => Http::response($this->getJsonResponseMeta(5404, 706)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-03&time_range%5Buntil%5D=2024-06-03" => Http::response($this->getJsonResponseMeta(5256, 821)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-02&time_range%5Buntil%5D=2024-06-02" => Http::response($this->getJsonResponseMeta(5291, 211)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-01" => Http::response($this->getJsonResponseMeta(5119, 214)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-31&time_range%5Buntil%5D=2024-05-31" => Http::response($this->getJsonResponseMeta(7894, 308)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-30&time_range%5Buntil%5D=2024-05-30" => Http::response($this->getJsonResponseMeta(7786, 875)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-29&time_range%5Buntil%5D=2024-05-29" => Http::response($this->getJsonResponseMeta(2953, 11)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-28&time_range%5Buntil%5D=2024-05-28" => Http::response($this->getJsonResponseMeta(8784, 609)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-27&time_range%5Buntil%5D=2024-05-27" => Http::response($this->getJsonResponseMeta(4465, 792)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-26&time_range%5Buntil%5D=2024-05-26" => Http::response($this->getJsonResponseMeta(8515, 674)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-25&time_range%5Buntil%5D=2024-05-25" => Http::response($this->getJsonResponseMeta(2338, 208)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-24&time_range%5Buntil%5D=2024-05-24" => Http::response($this->getJsonResponseMeta(9963, 962)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-23&time_range%5Buntil%5D=2024-05-23" => Http::response($this->getJsonResponseMeta(7813, 908)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-22&time_range%5Buntil%5D=2024-05-22" => Http::response($this->getJsonResponseMeta(5399, 332)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-05-21&time_range%5Buntil%5D=2024-05-21" => Http::response($this->getJsonResponseMeta(6363, 395)),
            "https://graph.facebook.com/v20.0/act_3055428861222484/insights?fields=clicks,spend&action_attribution_windows=%5B'7d_click','1d_view'%5D&time_range%5Bsince%5D=2024-06-01&time_range%5Buntil%5D=2024-06-20" => Http::response($this->getJsonResponseMeta(103650, 9758))
        ]);
    }
}
