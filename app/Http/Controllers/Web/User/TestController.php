<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Dealer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $string = '[
 {
  "customer_tax_number": 16775565248,
  "dealer_tax_number": 1111111111
 },
 {
  "customer_tax_number": "0011654432",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0020542594",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0020556220",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0051094710",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0060063117",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0071059459",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0071130282",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0071150078",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0071361906",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0080781635",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0081617502",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0100674216",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0101759785",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0110197567",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0110452110",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0111149089",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0140400847",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0160492680",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0160833208",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0220324471",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0270010119",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0330425657",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0350405934",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0380918989",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0450022264",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0500521713",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0550842416",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0570257950",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0580023608",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0590502489",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0681824826",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0720817580",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0910538753",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0910548265",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0910554248",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1280447670,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1280945889,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1340263600,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1510439576,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1600721485,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 16094056168,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1630420861,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1650042791,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1650473246,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1660045452,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1670549306,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1830018616,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1850050834,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 1920311942,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 21976859546,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 2460559418,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 24605594184,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 2560166895,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 27484707010,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 28942677364,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 2930495875,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 30415944538,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3061150440,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3080658995,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 30865604990,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3100186481,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3290037212,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3310495325,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3320413422,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3330108478,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3350462797,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3360552012,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3360564991,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3530506981,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3610052827,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 36637903940,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 36973001874,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3760120158,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3790651497,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 37909380414,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3850016785,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3870585618,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3890337808,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3890744614,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3890779647,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3890797672,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3891338775,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3910070716,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 39130326018,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 3961008655,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 40744284564,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4090335645,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4100702855,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 41122264574,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4380058226,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4380445042,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 44128171648,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4510041288,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 45742901260,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4580421174,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4581438867,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4581511227,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4630339310,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4780524897,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4801060095,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 48094030480,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4820924606,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4940162345,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 4950633775,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 5550193488,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 5550876912,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 5990133502,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6090844955,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6100873556,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6110403825,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6110494436,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6110528067,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6120637488,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6130764756,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6130782251,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6140273679,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6190540314,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6210490528,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6230447267,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6230461207,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6320129921,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6320139736,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6320274865,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6450053937,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6460365019,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6480665298,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6510115217,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 65470249502,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6570069860,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 65971229584,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 6860150611,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7030338531,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7040370545,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7040370626,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7190188614,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7200070609,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7280394532,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7290013162,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7300384557,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7320841039,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7321585372,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7341443912,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7360418861,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7360587343,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7580260132,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7600468051,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7620438140,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7700040401,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7710321968,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7890166717,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 7970553121,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 8110331743,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 8400387695,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 8550337099,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 8590919708,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 8880529892,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 9360655731,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 9380433420,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 9810626953,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 99379819016,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 9971400839,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 9980860749,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 9991081581,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 99931441662,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0011755035",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0110557276",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0270328009",
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": 19132201346,
  "dealer_tax_number": 1111111111
 },
 {
  "customer_tax_number": 2150026696,
  "dealer_tax_number": 1111111111
 },
 {
  "customer_tax_number": 25466282432,
  "dealer_tax_number": 1111111111
 },
 {
  "customer_tax_number": "0710431871",
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 11123720232,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 1230928160,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 12554469028,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 12688419920,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 14036406330,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 15568981272,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 16825199270,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 1700318993,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 1750249653,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 1760402688,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 1870605614,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 19954816070,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 20936384128,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 22492295566,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 23023039192,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 23765429312,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 24695040134,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 25981496734,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 28564846520,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 28640057338,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 2930998533,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 38500842202,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 3851472142,
  "dealer_tax_number": 1700318993
 },
 {
  "customer_tax_number": 2090004225,
  "dealer_tax_number": 11111111113
 },
 {
  "customer_tax_number": 2090004320,
  "dealer_tax_number": 11111111113
 },
 {
  "customer_tax_number": 2940039878,
  "dealer_tax_number": 11111111113
 },
 {
  "customer_tax_number": 3011053745,
  "dealer_tax_number": 11111111113
 },
 {
  "customer_tax_number": 3011053761,
  "dealer_tax_number": 11111111113
 },
 {
  "customer_tax_number": 3011055919,
  "dealer_tax_number": 11111111113
 },
 {
  "customer_tax_number": "0610817692",
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": "0620260192",
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": "0730805690",
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": "0850812080",
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": "0850895167",
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": "0911109720",
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": "0980446630",
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 10069256492,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 11374054780,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 12545977358,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 1300978764,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 1310583917,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 1310719128,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 1601653053,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 1610837485,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 16721214206,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 16898405438,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 1750903670,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 17674711194,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 1770716490,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 1780108427,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 19571387854,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 22196342740,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 22435677466,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 2280748246,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 2280767501,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 2520904179,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 25328120452,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 2550049893,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 28642817862,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 2931017442,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 2960416333,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 30530201486,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": 3850503794,
  "dealer_tax_number": 3680418786
 },
 {
  "customer_tax_number": "0900273905",
  "dealer_tax_number": 21266762204
 },
 {
  "customer_tax_number": "0680241776",
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": "0690449031",
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": "0800033235",
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": "0910360504",
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": "0990533990",
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 10082851308,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 10103621194,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 10169722064,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 1050617295,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 10534779792,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 10714992744,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 10773027838,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 10781963432,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 10793077868,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 1090434269,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 10997579120,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 1150557517,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 11618528596,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 11753708822,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 11789547204,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 12869506692,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 13598585958,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 14090655538,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 1421332414,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 14303681804,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 14648469518,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 14678468598,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 15178615802,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 15253550714,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 1530119689,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 15331781672,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 15442180128,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 16031211476,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 16034526300,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 16168664626,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 16202388280,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 16825168412,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 16858624640,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 17005578564,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 17012371912,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 1750606931,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 1781262081,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 18188344434,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 18200468964,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 18488312072,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 18554172890,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 18572316542,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 18593315814,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 19007290772,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 19171564600,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 19273230298,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 19277432780,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 19609453018,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 2010304813,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 20240475802,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 2060697600,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 21008257500,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 2160072710,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 22351335396,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 22400182896,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 22766298934,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 22987836274,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 23056140810,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 23477451014,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 23518603648,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 23966015710,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 24332347480,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 24604268956,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 24632108668,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 24674008674,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 25141052268,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 25235105238,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 25319384566,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 25378234352,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 25559097394,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 25930845040,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 26333073108,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 26834061246,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 27506111924,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 2780491658,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 27826561782,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 27829561628,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 28142011920,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 28159988864,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 28279168788,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 28606975812,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 2900655415,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 2910822496,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 2910837562,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 29185962316,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 2920546192,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 29731752804,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 29746752394,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 29788124012,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 30454924348,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 30685720764,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 30836300890,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 30874921644,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 3850140014,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 3850749169,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 38686650462,
  "dealer_tax_number": 4820159045
 },
 {
  "customer_tax_number": 3850577293,
  "dealer_tax_number": null
 },
 {
  "customer_tax_number": "0550918857",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0550945689",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0570456458",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0580583663",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0630240316",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0660194012",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0680513264",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0680872782",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0690877036",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0700005643",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0700594149",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0700697678",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0700986662",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0730503313",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0790368951",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0800350472",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0800364152",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0840495297",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0860154514",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0860167363",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0860386192",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0861076732",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0861384478",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0910515855",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0910538134",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": "0990543223",
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1020144592,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1020421477,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10216354484,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10293069202,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1030185059,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10304300270,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10346290768,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10382296786,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10487293352,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10630878788,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10700268600,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10760265502,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1090650705,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 10943649556,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 11336607030,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 11451038924,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 11495241816,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1210434892,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1211007863,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 12183086054,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1230104345,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1230154121,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1230462638,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 12309018082,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 12620212770,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1270078422,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1270373357,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1270654808,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 12731209072,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 12851197082,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1290805622,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 12919796790,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 12929203424,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 12946260066,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13100197440,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13112195328,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1320067270,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1320755250,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13264366966,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13313186736,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13442186010,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13529173360,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13535190412,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13747371036,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1380335808,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13817967978,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13823185304,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1390372445,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1391995005,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 13919950052,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1394994906,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1394999064,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1400387308,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1421445140,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1500200573,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 15011091930,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1510424771,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 15236125656,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 15278126338,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1530671297,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 15728106460,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1580042224,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 15845114010,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 15989091956,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1601100612,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16022880018,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1610405773,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1610778877,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1610832992,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16169084218,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16175085148,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16382980984,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1640443198,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16433979226,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1650710588,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1660012094,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1660404602,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1660697876,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16631069866,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16670622268,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16697069060,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16706068992,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1681093558,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1681152321,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 16910961294,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 17000393216,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1700497005,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1700676861,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 17044665362,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 17093390192,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 17234049842,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1740345655,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1750030962,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1752203916,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1760360633,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 17747836496,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 17759040294,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 17783032180,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1781466148,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 17825031096,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1800011518,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1800582383,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1800854369,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1820498724,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1820502631,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 18272341660,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1831328305,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1841301844,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 18659020966,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1880816623,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 18989010736,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1901436222,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1910609454,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 19262770576,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 19282981730,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 19340767962,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 19363986814,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 19417978376,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1980425449,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 1980819478,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2010123332,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 20110973216,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2020342509,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 20246737584,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 20369225616,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2050566715,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2060690988,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2060706053,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 20609555114,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2061266466,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 20740934076,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 20818940596,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 20896929230,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2090048068,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 21002247828,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2110638078,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2110640337,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2110699917,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 21665690252,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2170400710,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 21718910818,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 21751899484,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 21772909018,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2180026542,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 21916899960,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 21962693222,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 22225884586,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 22303957898,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 22636868540,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 22684868318,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 22711469372,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 22720469080,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2290056434,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 22999078006,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2302086294,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 23077861060,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 23080863426,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2316185822,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 23182857590,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 23590847312,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 23669623120,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 24064830366,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 24196983800,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 24526801828,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2510042044,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 25126893602,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 25153795276,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2530778224,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 25393380294,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 25739261690,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2581870244,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2581980312,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 25924989996,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 25945760222,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 25969759462,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 26018070880,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 26069544736,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 26188751312,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2640103154,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2662975917,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2671436889,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 26749751102,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 26881738238,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 27022733624,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2720882219,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2730138346,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2730669085,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 27430297824,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 27574705018,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 27776601118,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 27823714464,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 27904694708,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 28129695822,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 28234684322,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 28621679696,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 28708668858,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2910828467,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2920602682,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 2930468282,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 29332647028,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 29362744704,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 29473641534,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 30122520544,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3020404573,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3020536347,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3026261523,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 30349612312,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 30349612862,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 30439632190,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 30478618568,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3070396178,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 30829601492,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3090335740,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3810469379,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3810709342,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3830861227,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 38389353844,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3840328411,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3840706985,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 38503348992,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3850520974,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3850633974,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3870158391,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3880421146,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3880797560,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 3880979341,
  "dealer_tax_number": 6230461207
 },
 {
  "customer_tax_number": 11918875932,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": 16153102492,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": 16706664590,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": 18053127940,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": 22157432534,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": 22703495990,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": 2741689527,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": 3060507100,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": 3810816429,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": 38282021130,
  "dealer_tax_number": 3410039828
 },
 {
  "customer_tax_number": "0910018752",
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 10481085298,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 11202003874,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 11474265628,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 13013413118,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 14407953968,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 14599947974,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 15160929306,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 15175928806,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 15889904868,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 16246759190,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 17138606158,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 17281460010,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 1950022010,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 19978424992,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 20758794990,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 2090050432,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 20906241970,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 2100220591,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 21286554766,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 21635792566,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 21958533556,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 22910413732,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 2310008831,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 23485473084,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 25042430448,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 29893490194,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": 30599157908,
  "dealer_tax_number": 8150873149
 },
 {
  "customer_tax_number": "0730658913",
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": "0861273270",
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": "0861286725",
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": "0940015328",
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 10598220018,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 10774165584,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 11374875040,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 12041486354,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 12800696338,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 1430686675,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 15833008468,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 1601340694,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 16418364092,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 1650308531,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 16703073838,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 17056125052,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 17192167992,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 1800451363,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 1880516979,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 20729247104,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 20909156158,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 21923386958,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 24058771330,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 24116082644,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 24206054216,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 24314581918,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 24799083136,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 25063767578,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 25882612868,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 2650015292,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 26554999706,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 2700863000,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 27592978852,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 27853973756,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 28565585374,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 2870323138,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 29989633368,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 3010958900,
  "dealer_tax_number": 11111111112
 },
 {
  "customer_tax_number": 10570087356,
  "dealer_tax_number": 4760430163
 },
 {
  "customer_tax_number": 12256169226,
  "dealer_tax_number": 4760430163
 },
 {
  "customer_tax_number": 13591011348,
  "dealer_tax_number": 4760430163
 },
 {
  "customer_tax_number": 15781261304,
  "dealer_tax_number": 4760430163
 },
 {
  "customer_tax_number": 2140643738,
  "dealer_tax_number": 4760430163
 },
 {
  "customer_tax_number": 2310707029,
  "dealer_tax_number": 4760430163
 },
 {
  "customer_tax_number": 2700484893,
  "dealer_tax_number": 4760430163
 },
 {
  "customer_tax_number": 2930813209,
  "dealer_tax_number": 4760430163
 },
 {
  "customer_tax_number": 3830447293,
  "dealer_tax_number": 4760430163
 }
]';
        $rows = json_decode($string);
        $response = [];
        foreach ($rows as $row) {
            if ($row->customer_tax_number != null && $row->dealer_tax_number != null) {
                $customer = Customer::where('tax_number', $row->customer_tax_number)->first();
                if ($customer) {
                    $dealer = Dealer::where('tax_number', $row->dealer_tax_number)->first();
                    if ($dealer) {
                        $customer->dealer_id = $dealer->id;
                        $customer->save();
                    }
                }
            }
        }

        return $response;
    }
}
