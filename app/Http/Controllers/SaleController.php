<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\SaleFormRequest;
use sisVentas\Models\Sale;
use sisVentas\Models\Voucher;
use sisVentas\Models\DetailSale;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $sales = DB::table('sale as s')
                ->join('person as p', 's.idclient', '=', 'p.idperson')
                ->join('detail_sale as di', 's.idsale', '=', 'di.id_sale')
                ->join('voucher as v', 's.idvoucher', '=', 'v.idvoucher')
                ->select('p.idperson', 's.idsale', 's.date_time', 'p.name', 'v.serie_voucher', 'v.num_voucher', 'v.type_voucher', 's.tax', 's.status', 's.total_sale')
                ->where('v.num_voucher', 'LIKE', '%' . $query . '%')
                ->orderBy('s.idsale', 'desc')
                ->groupBy('s.idsale', 's.date_time', 'p.name', 'v.serie_voucher', 'v.num_voucher', 's.tax', 's.status')
                ->paginate(7);
            return view('store.sales.sale.index', ['sales' => $sales, 'searchText' => $query]);
        }
    }

    public function create()
    {
        $persons = DB::table('person')->where('type_person', '=', 'client')->get();
        $articles = DB::table('article as art')
            ->join('detail_income as di', 'art.idarticle', 'di.id_article')
            ->select(DB::raw('CONCAT(art.code, " ", art.name) AS article'), 'art.idarticle', 'art.stock', DB::raw('avg(di.price_sale) as price_average'))
            ->where('art.status', '=', '1')
            ->where('art.stock', '>', '0')
            ->groupBy('article', 'art.idarticle', 'art.stock')
            ->get();
        return view('store.sales.sale.create', ['people' => $persons, 'articles' => $articles]);
    }

    public function store(SaleFormRequest $request)
    {
        try {
            DB::beginTransaction();
            // FIRST
            $voucher = new Voucher();
            $voucher->type_voucher = $request->get('type_voucher');
            $voucher->serie_voucher = $request->get('serie_voucher');
            $voucher->num_voucher = $request->get('num_voucher');
            $voucher->save();

            $sale = new Sale();
            $sale->idclient = $request->get('idclient');
            $sale->idvoucher = $voucher->idvoucher;

            // SECOND
            $myTime = Carbon::now('America/Bogota');
            $sale->date_time = $myTime->toDateTimeString();
            $sale->tax = '19';
            $sale->total_sale = $request->get('total_sale');
            $sale->status = '1';
            $sale->save();

            $id_article = $request->get('pidarticle');
            $quantity = $request->get('pquantity');
            $price_sale = $request->get('pselling');
            $discount = $request->get('pselling');
            // THIRD
            $cont = 0;

            while ($cont < count($id_article)) {
                $detail = new DetailSale();
                $detail->id_sale = $sale->idsale;
                $detail->id_article = $id_article[$cont];
                $detail->quantity = $quantity[$cont];
                $detail->discount = $discount[$cont];
                $detail->price_sale = $price_sale[$cont];
                $detail->save();
                $cont++;
            }
            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }
        return Redirect::to('ventas/venta');
    }

    public function show($id)
    {
        $sale = DB::table('sale as s')
            ->join('person as p', 's.idclient', '=', 'p.idperson')
            ->join('detail_sale as ds', 's.idsale', '=', 'ds.id_sale')
            ->join('voucher as v', 's.idvoucher', '=', 'v.idvoucher')
            ->select('s.idsale', 's.date_time', 'p.name', 'v.serie_voucher', 'v.type_voucher', 'v.num_voucher', 's.tax', 's.status', 's.total_sale')
            ->where('s.idsale', '=', $id)
            ->first();

        $details = DB::table('detail_sale as d')
            ->join('article as a', 'd.id_article', '=', 'a.idarticle')
            ->select('a.name as article', 'd.quantity', 'd.discount', 'd.price_sale')
            ->where('d.id_sale', '=', $id)
            ->get();
        return view('store.sales.sale.show', ['sale' => $sale, 'details' => $details]);
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->status = '0';
        $sale->update();
        return Redirect::to('ventas/venta');
    }
}
