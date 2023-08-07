<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\IncomeFormRequest;
use sisVentas\Models\Income;
use sisVentas\Models\Voucher;
use sisVentas\Models\DetailIncome;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            $incomes = DB::table('income as i')
                ->join('person as p', 'i.idprovider', '=', 'p.idperson')
                ->join('detail_income as di', 'i.idincome', '=', 'di.id_income')
                ->join('voucher as v', 'i.idvoucher', '=', 'v.idvoucher')
                ->select('p.idperson', 'i.idincome', 'i.date_time', 'p.name', 'v.serie_voucher', 'v.num_voucher', 'v.type_voucher', 'i.tax', 'i.status', DB::raw('sum(di.quantity*price_purchase) as total'))
                ->where('v.num_voucher', 'LIKE', '%' . $query . '%')
                ->orderBy('i.idincome', 'desc')
                ->groupBy('i.idincome', 'i.date_time', 'p.name', 'v.serie_voucher', 'v.num_voucher', 'i.tax', 'i.status')
                ->paginate(7);
            return view('store.purchase.income.index', ['incomes' => $incomes, 'searchText' => $query]);
        }
    }

    public function create()
    {
        $persons = DB::table('person')->where('type_person', '=', 'provider')->get();
        $articles = DB::table('article as art')
            ->select(DB::raw('CONCAT(art.code, " ", art.name) AS article'), 'art.idarticle')
            ->where('art.status', '=', '1')
            ->get();
        return view('store.purchase.income.create', ['people' => $persons, 'articles' => $articles]);
    }

    public function store(IncomeFormRequest $request)
    {
        try {
            DB::beginTransaction();
            // FIRST
            $voucher = new Voucher();
            $voucher->type_voucher = $request->get('type_voucher');
            $voucher->serie_voucher = $request->get('serie_voucher');
            $voucher->num_voucher = $request->get('num_voucher');
            $voucher->save();

            $income = new Income();
            $income->idprovider = $request->get('idprovider');
            $income->idvoucher = $voucher->idvoucher;

            // SECOND
            $myTime = Carbon::now('America/Bogota');
            $income->date_time = $myTime->toDateTimeString();
            $income->tax = '19';
            $income->status = '1';
            $income->save();

            $id_article = $request->get('idarticle');
            $quantity = $request->get('quantity');
            $price_sale = $request->get('selling');
            $price_purchase = $request->get('purchase');
            // THIRD
            $cont = 0;

            while ($cont < count($id_article)) {
                $detail = new DetailIncome();
                $detail->id_income = $income->idincome;
                $detail->id_article = $id_article[$cont];
                $detail->price_sale = $price_sale[$cont];
                $detail->quantity = $quantity[$cont];
                $detail->price_purchase = $price_purchase[$cont];
                $detail->save();
                $cont++;
            }
            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }
        return Redirect::to('compras/ingresos');
    }

    public function show($id)
    {
        $income = DB::table('income as i')
            ->join('person as p', 'i.idprovider', '=', 'p.idperson')
            ->join('detail_income as di', 'i.idincome', '=', 'di.id_income')
            ->join('voucher as v', 'i.idvoucher', '=', 'v.idvoucher')
            ->select('i.idincome', 'i.date_time', 'p.name', 'v.serie_voucher', 'v.type_voucher', 'v.num_voucher', 'i.tax', 'i.status', DB::raw('sum(di.quantity*price_purchase) as total'))
            ->where('i.idincome', '=', $id)
            ->groupBy('di.iddetail_income')
            ->first();

        $details = DB::table('detail_income as d')
            ->join('article as a', 'd.id_article', '=', 'a.idarticle')
            ->select('a.name as article', 'd.quantity', 'd.price_purchase', 'd.price_sale')
            ->where('d.id_income', '=', $id)
            ->get();
        return view('store.purchase.income.show', ['income' => $income, 'details' => $details]);
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->status = '1';
        $income->update();
        return Redirect::to('compras/ingresos');
    }
}
