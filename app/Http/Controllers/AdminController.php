<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AdminModel;
use App\Models\CustomerModel;
use App\Models\Expense;
use App\Models\ExpenseRecord;
use App\Models\ItemsModel;
use App\Models\PartyModel;
use App\Models\SlabModel;
use App\Models\StateModel;
use App\Models\UnitModel;
use App\Models\PurchaseHistory;
use App\Models\PurchaseItem;
use App\Models\SalesHistory;
use App\Models\SalesItems;
use App\Models\Transaction;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    //

    function index()
    {
        echo view('home');
    }

    function login()
    {
        if (Session::has('admin')) {
            return redirect('dashboard');
        } else {
            echo view('login');
        }
    }

    function checklogin(Request $req)
    {
        if (Session::has('admin')) {
            return redirect('dashboard');
        } else {
            $uname = $req->uname;
            $upass = $req->upass;
            $admin = AdminModel::where('a_user', '=', $uname)->where('a_pass', '=', $upass)->get();
            if ($admin->count() == 1) {
                foreach ($admin as $data) {
                    session()->put('admin', $data->a_name);
                }

                echo 1;
            } else {
                echo 0;
            }
        }
    }

    function dashboard()
    {
        if (Session::has('admin')) {
            echo view('common/header') . view('dashboard') . view('common/footer');
        } else {
            echo view('login');
        }
    }

    function purchase_entry()
    {
        if (Session::has('admin')) {
            $units = UnitModel::where('u_status', '=', 0)->get();
            $slab = SlabModel::get();
            echo view('common/header') . view('purchase_entry', compact('units', 'slab')) . view('common/footer');
        } else {
            echo view('login');
        }
    }

    function sales_entry()
    {
        if (Session::has('admin')) {
            echo view('common/header') . view('sales_entry') . view('common/footer');
        } else {
            echo view('login');
        }
    }

    function purchase_entries()
    {
        if (Session::has('admin')) {
            echo view('common/header') . view('purchase_entries') . view('common/footer');
        } else {
            echo view('login');
        }
    }

    function sales_entries()
    {
        if (Session::has('admin')) {
            echo view('common/header') . view('sales_entries') . view('common/footer');
        } else {
            echo view('login');
        }
    }

    function manage_stock()
    {
        if (Session::has('admin')) {
            $units = UnitModel::where('u_status', '=', 0)->get();
            $slab = SlabModel::get();
            echo view('common/header') . view('manage_stock', compact('units', 'slab')) . view('common/footer');
        } else {
            echo view('login');
        }
    }

    function khatabook()
    {
        if (Session::has('admin')) {
            echo view('common/header') . view('khatabook') . view('common/footer');
        } else {
            echo view('login');
        }
    }

    function settings()
    {
        if (Session::has('admin')) {
            $settings = AdminModel::where('a_name', '=', session('admin'))->get();
            $units = UnitModel::where('u_status', '=', 0)->get();
            echo view('common/header') . view('settings', compact('settings', 'units')) . view('common/footer');
        } else {
            echo view('login');
        }
    }

    function reset_password()
    {
        if (Session::has('admin')) {
            echo view('common/header') . view('reset_password') . view('common/footer');
        } else {
            echo view('login');
        }
    }

    function logout()
    {
        if (Session::has('admin')) {
            session()->flush();
            echo view('login');
        } else {
            echo view('login');
        }
    }

    function save_settings(Request $req)
    {
        if (Session::has('admin')) {
            $admin = AdminModel::find(1);
            $admin->a_name = $req->a_name;
            $admin->a_add = $req->a_add;
            $admin->a_gst = $req->a_gst;
            $admin->a_fmob = $req->a_fmob;
            $admin->a_smob = $req->a_smob;
            $admin->a_email = $req->a_email;
            $admin->a_alert = $req->a_alert;
            $admin->save();


            UnitModel::truncate();

            $allUnits = $req->units;

            if (isset($allUnits)) {
                foreach ($allUnits as $unit) {
                    $unitModel = new UnitModel();
                    if (!empty($unit)) {
                        $unitModel->u_name = $unit;
                        $unitModel->save();
                    }
                }
            }
            return redirect()->to('settings');
        } else {
            echo view('login');
        }
    }

    function save_product(Request $req)
    {
        if (Session::has('admin')) {
            if ($req->item_id != 0) {
                $items = ItemsModel::find($req->item_id);
            } else {
                $items = new ItemsModel;
                $items->item_stock_retail = 0;
            }
            $items->item_hsn = $req->item_hsn;
            $items->item_name = $req->item_name;
            $items->item_name_local = $req->item_name_local;
            $items->item_location = $req->item_location;
            $items->item_desc = $req->item_desc;
            $items->item_base_unit = $req->item_base_unit;
            $items->item_conversion_rate = $req->item_conversion_rate;
            $items->item_sub_unit = $req->item_sub_unit;
            $items->item_gst = $req->item_gst;
            $items->item_mrp = $req->item_mrp;
            $items->item_disc_whole = $req->item_disc_whole;
            $items->item_disc_retail = $req->item_disc_retail;
            $items->item_purchase_tax_type = 1;
            $items->item_sale_tax_type = 1;
            if ($req->item_purchase_tax_type == 2) {
                $items->item_purchase_rate = ($req->item_purchase_rate * (100 + $req->item_gst_slab) / 100);
            } else {
                $items->item_purchase_rate = $req->item_purchase_rate;
            }
            if ($req->item_sale_tax_type == 2) {
                $items->item_sale_rate_whole_base = ($req->item_sale_rate_whole_base * (100 + $req->item_gst_slab) / 100);
                $items->item_sale_rate_whole_sub = ($req->item_sale_rate_whole_sub * (100 + $req->item_gst_slab) / 100);
                $items->item_sale_rate_retail_base = ($req->item_sale_rate_retail_base * (100 + $req->item_gst_slab) / 100);
                $items->item_sale_rate_retail_sub = ($req->item_sale_rate_retail_sub * (100 + $req->item_gst_slab) / 100);
            } else {
                $items->item_sale_rate_whole_base = $req->item_sale_rate_whole_base;
                $items->item_sale_rate_whole_sub = $req->item_sale_rate_whole_sub;
                $items->item_sale_rate_retail_base = $req->item_sale_rate_retail_base;
                $items->item_sale_rate_retail_sub = $req->item_sale_rate_retail_sub;
            }
            $items->item_gst_slab = $req->item_gst_slab;
            if ($req->item_stock_whole == "") {
                $items->item_stock_whole = 0;
            } else {
                $items->item_stock_whole = $req->item_stock_whole;
            }

            if ($req->item_min_stock == "") {
                $items->item_min_stock = 0;
            } else {
                $items->item_min_stock = $req->item_min_stock;
            }
            $items->item_mfg_date = $req->item_mfg_date;
            $items->item_exp_date = $req->item_exp_date;
            $items->item_exp_alert_time = $req->item_exp_alert_time;
            $items->save();
            return redirect('manage-stock')->with('submitType', $req->submit_type);
        } else {
            echo view('login');
        }
    }

    function get_items(Request $req)
    {
        if (Session::has('admin')) {
            if ($req->type == 1) {
                $items = ItemsModel::where('item_purchase_tax_type', '=', 1)->get();
            } else {
                $items = ItemsModel::get();
            }
            return response()->json($items);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    function edit_item(Request $req)
    {
        if (Session::has('admin')) {
            $items = ItemsModel::where('item_id', '=', $req->id)->first();
            return response()->json($items);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    function get_state()
    {
        if (Session::has('admin')) {
            $items = StateModel::orderBy('s_name', 'asc')->get();
            return response()->json($items);
        } else {
            return response()->json(['message', 'You should reload the page now!'], 400);
        }
    }

    function get_parties()
    {
        if (Session::has('admin')) {
            $items = PartyModel::get();
            return response()->json($items);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    function edit_party(Request $req)
    {
        if (Session::has('admin')) {
            $party = PartyModel::find($req->id);
            if ($party) {
                return response()->json($party);
            } else {
                return response()->json(['status' => 'Party information not available!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function deleteStockAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $item = ItemsModel::find($request->id);
            if ($item) {
                if (Session::has('admin')) {
                    if ($item->delete()) {
                        return response()->json(['status' => true]);
                    } else {
                        return response()->json(['status' => 'Something went wrong from our end!'], 400);
                    }
                } else {
                    return response()->json(['status' => 'Please login again!'], 400);
                }
            } else {
                return response()->json(['status' => 'Stock already removed from server!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function savePurchaseEntry(Request $request)
    {
        if (Session::has('admin')) {
            if ($request->button_role == 3) {
                $history = PurchaseHistory::where('p_h_otp', '=', $request->p_e_b_otp)->first();
                $pitem = PurchaseItem::find($request->p_i_id);
                if ($pitem) {
                    $previousQty = $pitem->p_i_qty;
                }
                if ($history) {
                    $purchaseItem = PurchaseItem::find($request->p_i_id);
                    if ($purchaseItem) {
                        $purchaseItem->p_i_qty = $request->item_stock_whole;
                        $purchaseItem->p_i_rate = $request->item_purchase_rate;
                        $purchaseItem->p_i_total = $request->item_total;
                        $purchaseItem->save();

                        $history->p_h_dues = $request->p_h_dues;
                        $history->p_h_grand = $request->p_h_grand;
                        $history->p_h_total = $request->p_h_total;
                        $history->p_h_paid = $request->p_h_paid;
                        $history->p_h_dis = $request->p_h_dis;
                        $history->p_h_pre = $request->p_h_pre;
                        $history->p_h_other = $request->p_h_other;
                        $history->p_h_desc = $request->p_h_desc;
                        $history->save();
                        $mainItem = ItemsModel::find($request->item_id);
                        if ($request->item_purchase_tax_type == 2) {
                            $item_purchase_rate = ($request->item_purchase_rate * (100 + $request->item_gst_slab) / 100);
                        } else {
                            $item_purchase_rate = $request->item_purchase_rate;
                        }
                        if ($request->item_sale_tax_type == 2) {
                            $item_sale_rate_whole_base = ($request->item_sale_rate_whole_base * (100 + $request->item_gst_slab) / 100);
                            $item_sale_rate_whole_sub = ($request->item_sale_rate_whole_sub * (100 + $request->item_gst_slab) / 100);
                            $item_sale_rate_retail_base = ($request->item_sale_rate_retail_base * (100 + $request->item_gst_slab) / 100);
                            $item_sale_rate_retail_sub = ($request->item_sale_rate_retail_sub * (100 + $request->item_gst_slab) / 100);
                        } else {
                            $item_sale_rate_whole_base = $request->item_sale_rate_whole_base;
                            $item_sale_rate_whole_sub = $request->item_sale_rate_whole_sub;
                            $item_sale_rate_retail_base = $request->item_sale_rate_retail_base;
                            $item_sale_rate_retail_sub = $request->item_sale_rate_retail_sub;
                        }
                        if ($mainItem) {
                            $totalStock = ($mainItem->item_stock_whole - $previousQty) + $request->item_stock_whole;
                            $mainItem->update([
                                'item_hsn' => $request->item_hsn,
                                'item_name' => $request->item_name,
                                'item_name_local' => $request->item_name_local,
                                'item_location' => $request->item_location,
                                'item_desc' => $request->item_desc,
                                'item_base_unit' => $request->item_base_unit,
                                'item_conversion_rate' => $request->item_conversion_rate,
                                'item_sub_unit' => $request->item_sub_unit,
                                'item_gst' => $request->item_gst,
                                'item_purchase_rate' => $item_purchase_rate,
                                'item_purchase_tax_type' => 1,
                                'item_sale_tax_type' => 1,
                                'item_stock_retail' => 0,
                                'item_min_stock' => $request->item_min_stock,
                                'item_sale_rate_whole_base' => $item_sale_rate_whole_base,
                                'item_sale_rate_whole_sub' => $item_sale_rate_whole_sub,
                                'item_sale_rate_retail_base' => $item_sale_rate_retail_base,
                                'item_sale_rate_retail_sub' => $item_sale_rate_retail_sub,
                                'item_mfg_date' => $request->item_mfg_date,
                                'item_exp_date' => $request->item_exp_date,
                                'item_exp_alert_time' => $request->item_exp_alert_time,
                                'item_mrp' => $request->item_mrp,
                                'item_disc_whole' => $request->item_disc_whole,
                                'item_disc_retail' => $request->item_disc_retail,
                                'item_stock_whole' => $totalStock
                            ]);
                        } else {
                            $mainItem = ItemsModel::create([
                                'item_hsn' => $request->item_hsn,
                                'item_name' => $request->item_name,
                                'item_name_local' => $request->item_name_local,
                                'item_location' => $request->item_location,
                                'item_desc' => $request->item_desc,
                                'item_base_unit' => $request->item_base_unit,
                                'item_conversion_rate' => $request->item_conversion_rate,
                                'item_sub_unit' => $request->item_sub_unit,
                                'item_gst' => $request->item_gst,
                                'item_purchase_rate' => $item_purchase_rate,
                                'item_purchase_tax_type' => 1,
                                'item_sale_tax_type' => 1,
                                'item_stock_retail' => 0,
                                'item_min_stock' => $request->item_min_stock,
                                'item_sale_rate_whole_base' => $item_sale_rate_whole_base,
                                'item_sale_rate_whole_sub' => $item_sale_rate_whole_sub,
                                'item_sale_rate_retail_base' => $item_sale_rate_retail_base,
                                'item_sale_rate_retail_sub' => $item_sale_rate_retail_sub,
                                'item_mfg_date' => $request->item_mfg_date,
                                'item_exp_date' => $request->item_exp_date,
                                'item_exp_alert_time' => $request->item_exp_alert_time,
                                'item_mrp' => $request->item_mrp,
                                'item_disc_whole' => $request->item_disc_whole,
                                'item_disc_retail' => $request->item_disc_retail,
                                'item_stock_whole' => $request->item_stock_whole
                            ]);
                            $pitem = PurchaseItem::create([
                                'p_i_p_h_id' => $history->p_h_id,
                                'p_i_item_id' => $mainItem->item_id,
                                'p_i_qty' => $request->item_stock_whole,
                                'p_i_rate' => $request->item_purchase_rate,
                                'p_i_total' => $request->item_total,
                            ]);
                            $isPartyUpdated = $this->updateParty($request);
                            if ($isPartyUpdated) {
                                $data = [];
                                $invTotal = 0;
                                $purchaseItems = PurchaseItem::where('p_i_p_h_id', $history->p_h_id)->orderBy('p_i_id', 'desc')->get();
                                foreach ($purchaseItems as $pi) {
                                    $item = ItemsModel::find($pi->p_i_item_id);
                                    $invTotal += $pi->p_i_total;
                                    $data[] = array_merge($pi->toArray(), $item->toArray());
                                }
                                // Accounts and transactions calculations starting
                                $transaction = UserTransaction::Find(Session::get('tnx_id'));
                                $account = Account::find($request->tnx_account);
                                if ($request->p_h_desc == '') {
                                    $description = 'No description';
                                } else {
                                    $description = $request->p_h_desc;
                                }
                                if ($transaction) {
                                    $fianlAcBal = ((int)$account->account + (int)$transaction->tnx_amount) - (int)$request->p_h_paid;
                                    $account->ac_balance = $fianlAcBal;
                                    $account->save();
                                    $amt = (int)$request->p_h_total - (int)$request->p_h_paid;
                                    if ($amt >= 0) {
                                        $transaction->update([
                                            'tnx_user_id' => $isPartyUpdated->p_id,
                                            'tnx_user_type' => 2,
                                            'tnx_date' => $request->p_h_bill_date,
                                            'tnx_p_amount' => $amt,
                                            'tnx_amount' => $request->p_h_paid,
                                            'tnx_type' => 2,
                                            'tnx_final_dues' => $isPartyUpdated->p_dues,
                                            'tnx_account' => $account->ac_id,
                                            'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                            'tnx_closing_ac_bal' => $fianlAcBal,
                                            'tnx_invoice' => $history->p_h_id
                                        ]);
                                    } else {
                                        $transaction->update([
                                            'tnx_user_id' => $isPartyUpdated->p_id,
                                            'tnx_user_type' => 2,
                                            'tnx_date' => $request->p_h_bill_date,
                                            'tnx_p_amount' => -1 * $amt,
                                            'tnx_amount' => $request->p_h_paid,
                                            'tnx_type' => 3,
                                            'tnx_final_dues' => $isPartyUpdated->p_dues,
                                            'tnx_account' => $account->ac_id,
                                            'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                            'tnx_closing_ac_bal' => $fianlAcBal,
                                            'tnx_invoice' => $history->p_h_id
                                        ]);
                                    }
                                } else {
                                    $fianlAcBal = (int)$account->ac_balance - (int)$request->p_h_paid;
                                    $account->ac_balance = $fianlAcBal;
                                    $account->save();
                                    $amt = (int)$request->p_h_total - (int)$request->p_h_paid;
                                    if ($amt >= 0) {
                                        $transaction->update([
                                            'tnx_user_id' => $isPartyUpdated->p_id,
                                            'tnx_user_type' => 2,
                                            'tnx_date' => $request->p_h_bill_date,
                                            'tnx_p_amount' => $amt,
                                            'tnx_amount' => $request->p_h_paid,
                                            'tnx_type' => 2,
                                            'tnx_final_dues' => $isPartyUpdated->p_dues,
                                            'tnx_account' => $account->ac_id,
                                            'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                            'tnx_closing_ac_bal' => $fianlAcBal,
                                            'tnx_invoice' => $history->p_h_id
                                        ]);
                                    } else {
                                        $transaction->update([
                                            'tnx_user_id' => $isPartyUpdated->p_id,
                                            'tnx_user_type' => 2,
                                            'tnx_date' => $request->p_h_bill_date,
                                            'tnx_p_amount' => -1 * $amt,
                                            'tnx_amount' => $request->p_h_paid,
                                            'tnx_type' => 3,
                                            'tnx_final_dues' => $isPartyUpdated->p_dues,
                                            'tnx_account' => $account->ac_id,
                                            'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                            'tnx_closing_ac_bal' => $fianlAcBal,
                                            'tnx_invoice' => $history->p_h_id
                                        ]);
                                    }
                                }
                                // Accounts and transactions calculations ending
                                return response()->json([
                                    'role' => $request->button_role,
                                    'data' => $data,
                                    'partyData' => $isPartyUpdated,
                                    'previousItemID' => $request->item_id,
                                    'previousHistoryID' => $history->p_h_id,
                                    'invTotals' => $invTotal,
                                    'history' => $history,
                                    'transaction' => $transaction
                                ]);
                            } else {
                                return response()->json(['message' => 'Party not updated!'], 400);
                            }
                        }

                        if (!$pitem->update(['p_i_qty' => $request->item_stock_whole, 'p_i_total' => $request->item_total])) {
                            return response()->json(['message' => 'Purchase item not updated!'], 400);
                        }

                        $isPartyUpdated = $this->updateParty($request);
                        if ($isPartyUpdated) {
                            $data = [];
                            $invTotal = 0;
                            $purchaseItems = PurchaseItem::where('p_i_p_h_id', $history->p_h_id)->orderBy('p_i_id', 'desc')->get();
                            foreach ($purchaseItems as $pi) {
                                $item = ItemsModel::find($pi->p_i_item_id);
                                $invTotal += $pi->p_i_total;
                                $data[] = array_merge($pi->toArray(), $item->toArray());
                            }
                            // Accounts and transactions calculations starting
                            $transaction = UserTransaction::Find(Session::get('tnx_id'));
                            $account = Account::find($request->account);
                            if ($request->p_h_desc == '') {
                                $description = 'No description';
                            } else {
                                $description = $request->p_h_desc;
                            }
                            if ($transaction) {
                                $fianlAcBal = ((int)$account->ac_balance + (int)$transaction->tnx_amount) - (int)$request->p_h_paid;
                                $account->ac_balance = $fianlAcBal;
                                $account->save();
                                $amt = (int)$request->p_h_total - (int)$request->p_h_paid;
                                if ($amt >= 0) {
                                    $transaction->update([
                                        'tnx_user_id' => $isPartyUpdated->p_id,
                                        'tnx_user_type' => 2,
                                        'tnx_date' => $request->p_h_bill_date,
                                        'tnx_p_amount' => $amt,
                                        'tnx_amount' => $request->p_h_paid,
                                        'tnx_type' => 2,
                                        'tnx_final_dues' => $isPartyUpdated->p_dues,
                                        'tnx_account' => $account->ac_id,
                                        'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                        'tnx_closing_ac_bal' => $fianlAcBal,
                                        'tnx_invoice' => $history->p_h_id
                                    ]);
                                } else {
                                    $transaction->update([
                                        'tnx_user_id' => $isPartyUpdated->p_id,
                                        'tnx_user_type' => 2,
                                        'tnx_date' => $request->p_h_bill_date,
                                        'tnx_p_amount' => -1 * $amt,
                                        'tnx_amount' => $request->p_h_paid,
                                        'tnx_type' => 3,
                                        'tnx_final_dues' => $isPartyUpdated->p_dues,
                                        'tnx_account' => $account->ac_id,
                                        'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                        'tnx_closing_ac_bal' => $fianlAcBal,
                                        'tnx_invoice' => $history->p_h_id
                                    ]);
                                }
                            } else {
                                $fianlAcBal = (int)$account->ac_balance - (int)$request->p_h_paid;
                                $account->ac_balance = $fianlAcBal;
                                $account->save();
                                $amt = (int)$request->p_h_total - (int)$request->p_h_paid;
                                if ($amt >= 0) {
                                    $transaction->update([
                                        'tnx_user_id' => $isPartyUpdated->p_id,
                                        'tnx_user_type' => 2,
                                        'tnx_date' => $request->p_h_bill_date,
                                        'tnx_p_amount' => $amt,
                                        'tnx_amount' => $request->p_h_paid,
                                        'tnx_type' => 2,
                                        'tnx_final_dues' => $isPartyUpdated->p_dues,
                                        'tnx_account' => $account->ac_id,
                                        'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                        'tnx_closing_ac_bal' => $fianlAcBal,
                                        'tnx_invoice' => $history->p_h_id
                                    ]);
                                } else {
                                    $transaction->update([
                                        'tnx_user_id' => $isPartyUpdated->p_id,
                                        'tnx_user_type' => 2,
                                        'tnx_date' => $request->p_h_bill_date,
                                        'tnx_p_amount' => -1 * $amt,
                                        'tnx_amount' => $request->p_h_paid,
                                        'tnx_type' => 3,
                                        'tnx_final_dues' => $isPartyUpdated->p_dues,
                                        'tnx_account' => $account->ac_id,
                                        'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                        'tnx_closing_ac_bal' => $fianlAcBal,
                                        'tnx_invoice' => $history->p_h_id
                                    ]);
                                }
                            }
                            // Accounts and transactions calculations ending
                            return response()->json([
                                'role' => $request->button_role,
                                'data' => $data,
                                'partyData' => $isPartyUpdated,
                                'previousItemID' => $request->item_id,
                                'previousHistoryID' => $history->p_h_id,
                                'invTotals' => $invTotal,
                                'history' => $history,
                                'transaction' => $transaction
                            ]);
                        } else {
                            return response()->json(['message' => 'Party not updated!'], 400);
                        }
                    } else {
                        return response()->json(['message' => 'Purchase record not found!'], 400);
                    }
                } else {
                    return response()->json(['message' => 'History not found!'], 400);
                }
            }
            $oldHistory = PurchaseHistory::where('p_h_otp', '=', $request->p_e_b_otp)->first();
            if ($oldHistory) {
                $oldHistory->p_h_otp = $request->p_e_b_otp;
                $oldHistory->p_h_dues = $request->p_h_dues;
                $oldHistory->p_h_grand = $request->p_h_grand;
                $oldHistory->p_h_total = $request->p_h_total;
                $oldHistory->p_h_paid = $request->p_h_paid;
                $oldHistory->p_h_dis = $request->p_h_dis;
                $oldHistory->p_h_pre = $request->p_h_pre;
                $oldHistory->p_h_other = $request->p_h_other;
                $oldHistory->p_h_party_id = $request->p_id;
                $oldHistory->p_h_bill_no = $request->p_h_bill_no;
                $oldHistory->p_h_bill_date = $request->p_h_bill_date;
                $oldHistory->p_h_veh_no = $request->p_h_veh_no;
                $oldHistory->p_h_desc = $request->p_h_desc;
                $oldHistory->p_h_del_date = $request->p_h_del_date;
                $oldHistory->save();
                $isItemsCreated = $this->createPurchaseItems($oldHistory, $request);
                if ($isItemsCreated) {
                    $isPartyUpdated = $this->updateParty($request);
                    if ($isPartyUpdated) {
                        $data = [];
                        $invTotal = 0;
                        $purchaseItems = PurchaseItem::where('p_i_p_h_id', $oldHistory->p_h_id)->orderBy('p_i_id', 'desc')->get();
                        foreach ($purchaseItems as $pi) {
                            $item = ItemsModel::find($pi->p_i_item_id);
                            $invTotal += $pi->p_i_total;
                            $data[] = array_merge($pi->toArray(), $item->toArray());
                        }
                        // Accounts and transactions calculations starting
                        $transaction = UserTransaction::Find(Session::get('tnx_id'));
                        $account = Account::find($transaction->tnx_account);
                        $fianlAcBal = ((int)$account->ac_balance + (int)$transaction->tnx_amount) - (int)$request->p_h_paid;
                        $account->ac_balance = $fianlAcBal;
                        $account->save();
                        if ($request->p_h_desc == '') {
                            $description = 'No description';
                        } else {
                            $description = $request->p_h_desc;
                        }
                        $amt = (int)$request->p_h_total - (int)$request->p_h_paid;
                        if ($amt >= 0) {
                            $transaction->update([
                                'tnx_user_id' => $isPartyUpdated->p_id,
                                'tnx_user_type' => 2,
                                'tnx_date' => $request->p_h_bill_date,
                                'tnx_p_amount' => $amt,
                                'tnx_amount' => $request->p_h_paid,
                                'tnx_type' => 2,
                                'tnx_final_dues' => $isPartyUpdated->p_dues,
                                'tnx_account' => $account->ac_id,
                                'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                'tnx_closing_ac_bal' => $fianlAcBal,
                                'tnx_invoice' => $oldHistory->p_h_id
                            ]);
                        } elseif ($amt < 0) {
                            $transaction->update([
                                'tnx_user_id' => $isPartyUpdated->p_id,
                                'tnx_user_type' => 2,
                                'tnx_date' => $request->p_h_bill_date,
                                'tnx_p_amount' => -1 * $amt,
                                'tnx_amount' => $request->p_h_paid,
                                'tnx_type' => 3,
                                'tnx_final_dues' => $isPartyUpdated->p_dues,
                                'tnx_account' => $account->ac_id,
                                'tnx_remark' => $request->p_h_bill_no . ', ' . $description,
                                'tnx_closing_ac_bal' => $fianlAcBal,
                                'tnx_invoice' => $oldHistory->p_h_id
                            ]);
                        }
                        // Accounts and transactions calculations ending
                        return response()->json([
                            'role' => $request->button_role,
                            'data' => $data,
                            'partyData' => $isPartyUpdated,
                            'previousItemID' => $request->item_id,
                            'previousHistoryID' => $oldHistory->p_h_id,
                            'invTotals' => $invTotal,
                            'history' => $oldHistory,
                            'transaction' => $transaction
                        ]);
                    } else {
                        return response()->json(['status' => 'Party not updated!'], 400);
                    }
                } else {
                    return response()->json(['status' => 'Purchase items not created!'], 400);
                }
            } else {
                $history = new PurchaseHistory();
                $party = PartyModel::find($request->p_id);
                if ($party) {
                    $isPartyUpdated = $this->updateParty($request);
                    if ($isPartyUpdated) {
                        $partyID = $isPartyUpdated;
                    } else {
                        return response()->json(['status' => 'Party not updated!'], 400);
                    }
                } else {
                    $isPartyCreated = $this->createParty($request);
                    if ($isPartyCreated) {
                        $partyID = $isPartyCreated;
                    } else {
                        return response()->json(['status' => 'Party not created!'], 400);
                    }
                }
                if ($request->p_h_bill_no == '') {
                    $billNo = "BE" . rand(111111111, 999999999);
                    while (PurchaseHistory::where('p_h_bill_no', '=', $billNo)->exists()) {
                        $billNo = "BE" . rand(111111111, 999999999);
                    }
                } else {
                    if (PurchaseHistory::where('p_h_bill_no', '=', $request->p_h_bill_no)->exists()) {
                        $billNo = "BE" . rand(111111111, 999999999);
                        while (PurchaseHistory::where('p_h_bill_no', '=', $billNo)->exists()) {
                            $billNo = "BE" . rand(111111111, 999999999);
                        }
                    } else {
                        $billNo = $request->p_h_bill_no;
                    }
                }
                $history->p_h_otp = $request->p_e_b_otp;
                $history->p_h_bill_no = $billNo;
                $history->p_h_dues = $request->p_h_dues;
                $history->p_h_grand = $request->p_h_grand;
                $history->p_h_total = $request->p_h_total;
                $history->p_h_paid = $request->p_h_paid;
                $history->p_h_dis = $request->p_h_dis;
                $history->p_h_pre = $request->p_h_pre;
                $history->p_h_other = $request->p_h_other;
                $history->p_h_party_id = $partyID->p_id;
                $history->p_h_bill_date = $request->p_h_bill_date;
                $history->p_h_veh_no = $request->p_h_veh_no;
                $history->p_h_desc = $request->p_h_desc;
                $history->p_h_del_date = $request->p_h_del_date;
                $history->save();
                $isItemsCreated = $this->createPurchaseItems($history, $request);
                if ($isItemsCreated) {
                    $data = [];
                    $invTotal = 0;
                    $purchaseItems = PurchaseItem::where('p_i_p_h_id', $history->p_h_id)->orderBy('p_i_id', 'desc')->get();
                    foreach ($purchaseItems as $pi) {
                        $item = ItemsModel::find($pi->p_i_item_id);
                        $invTotal += $pi->p_i_total;
                        $data[] = array_merge($pi->toArray(), $item->toArray());
                    }
                    // Accounts and transactions calculations starting
                    $account = Account::find($request->account);
                    $fianlAcBal = (int)$account->ac_balance - (int)$history->p_h_paid;
                    $account->ac_balance = $fianlAcBal;
                    $account->save();
                    if ($request->p_h_desc == '') {
                        $description = 'No description';
                    } else {
                        $description = $request->p_h_desc;
                    }
                    $amt = (int)$request->p_h_total - (int)$request->p_h_paid;
                    if ($amt >= 0) {
                        $transaction = UserTransaction::create([
                            'tnx_user_id' => $partyID->p_id,
                            'tnx_user_name' => $partyID->p_name,
                            'tnx_user_type' => 2,
                            'tnx_date' => $history->p_h_bill_date,
                            'tnx_p_amount' => $amt,
                            'tnx_amount' => $request->p_h_paid,
                            'tnx_type' => 2,
                            'tnx_final_dues' => $partyID->p_dues,
                            'tnx_account' => $account->ac_id,
                            'tnx_remark' => $history->p_h_bill_no . ', ' . $description,
                            'tnx_closing_ac_bal' => $fianlAcBal,
                            'tnx_invoice' => $history->p_h_id
                        ]);
                    } elseif ($amt < 0) {
                        $transaction = UserTransaction::create([
                            'tnx_user_id' => $partyID->p_id,
                            'tnx_user_name' => $partyID->p_name,
                            'tnx_user_type' => 2,
                            'tnx_date' => $history->p_h_bill_date,
                            'tnx_p_amount' => -1 * $amt,
                            'tnx_amount' => $request->p_h_paid,
                            'tnx_type' => 3,
                            'tnx_final_dues' => $partyID->p_dues,
                            'tnx_account' => $account->ac_id,
                            'tnx_remark' => $history->p_h_bill_no . ', ' . $description,
                            'tnx_closing_ac_bal' => $fianlAcBal,
                            'tnx_invoice' => $history->p_h_id
                        ]);
                    }
                    Session::put('tnx_id', $transaction->tnx_id);
                    // Accounts and transactions calculations ending
                    return response()->json([
                        'role' => $request->button_role,
                        'data' => $data,
                        'partyData' => $partyID,
                        'previousItemID' => $request->item_id,
                        'previousHistoryID' => $history->p_h_id,
                        'invTotals' => $invTotal,
                        'history' => $history,
                        'transaction' => $transaction
                    ]);
                } else {
                    return response()->json(['status' => 'Purchase items not created!'], 400);
                }
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function createParty(Request $request)
    {
        if (Session::has('admin')) {
            $result = PartyModel::create([
                'p_name' => $request->p_name,
                'p_add' => $request->p_add,
                'p_fmob' => $request->p_fmob,
                'p_smob' => $request->p_smob,
                'p_gst' => $request->p_gst,
                'p_state' => $request->p_state,
                'p_desc' => $request->p_desc,
                'p_dues' => $request->p_h_dues,
            ]);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function updateParty(Request $request)
    {
        if (Session::has('admin')) {
            $party = PartyModel::find($request->p_id);
            $result = $party->update([
                'p_name' => $request->p_name,
                'p_add' => $request->p_add,
                'p_fmob' => $request->p_fmob,
                'p_smob' => $request->p_smob,
                'p_gst' => $request->p_gst,
                'p_state' => $request->p_state,
                'p_desc' => $request->p_desc,
                'p_dues' => $request->p_h_dues,
            ]);
            if ($result) {
                return $party;
            } else {
                return false;
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function createPurchaseItems(PurchaseHistory $history, Request $request)
    {
        if (Session::has('admin')) {
            $mainItem = ItemsModel::find($request->item_id);
            if ($request->item_purchase_tax_type == 2) {
                $item_purchase_rate = ($request->item_purchase_rate * (100 + $request->item_gst_slab) / 100);
            } else {
                $item_purchase_rate = $request->item_purchase_rate;
            }
            if ($request->item_sale_tax_type == 2) {
                $item_sale_rate_whole_base = ($request->item_sale_rate_whole_base * (100 + $request->item_gst_slab) / 100);
                $item_sale_rate_whole_sub = ($request->item_sale_rate_whole_sub * (100 + $request->item_gst_slab) / 100);
                $item_sale_rate_retail_base = ($request->item_sale_rate_retail_base * (100 + $request->item_gst_slab) / 100);
                $item_sale_rate_retail_sub = ($request->item_sale_rate_retail_sub * (100 + $request->item_gst_slab) / 100);
            } else {
                $item_sale_rate_whole_base = $request->item_sale_rate_whole_base;
                $item_sale_rate_whole_sub = $request->item_sale_rate_whole_sub;
                $item_sale_rate_retail_base = $request->item_sale_rate_retail_base;
                $item_sale_rate_retail_sub = $request->item_sale_rate_retail_sub;
            }
            if ($mainItem) {
                $mainItem->update([
                    'item_hsn' => $request->item_hsn,
                    'item_name' => $request->item_name,
                    'item_name_local' => $request->item_name_local,
                    'item_location' => $request->item_location,
                    'item_desc' => $request->item_desc,
                    'item_base_unit' => $request->item_base_unit,
                    'item_conversion_rate' => $request->item_conversion_rate,
                    'item_sub_unit' => $request->item_sub_unit,
                    'item_gst' => $request->item_gst,
                    'item_purchase_rate' => $item_purchase_rate,
                    'item_purchase_tax_type' => 1,
                    'item_sale_tax_type' => 1,
                    'item_gst_slab' => $request->item_gst_slab,
                    'item_stock_retail' => 0,
                    'item_min_stock' => $request->item_min_stock,
                    'item_sale_rate_whole_base' => $item_sale_rate_whole_base,
                    'item_sale_rate_whole_sub' => $item_sale_rate_whole_sub,
                    'item_sale_rate_retail_base' => $item_sale_rate_retail_base,
                    'item_sale_rate_retail_sub' => $item_sale_rate_retail_sub,
                    'item_mfg_date' => $request->item_mfg_date,
                    'item_exp_date' => $request->item_exp_date,
                    'item_mrp' => $request->item_mrp,
                    'item_disc_whole' => $request->item_disc_whole,
                    'item_disc_retail' => $request->item_disc_retail,
                    'item_exp_alert_time' => $request->item_exp_alert_time,
                    'item_stock_whole' => $mainItem->item_stock_whole + $request->item_stock_whole
                ]);
            } else {
                $mainItem = ItemsModel::create([
                    'item_hsn' => $request->item_hsn,
                    'item_name' => $request->item_name,
                    'item_name_local' => $request->item_name_local,
                    'item_location' => $request->item_location,
                    'item_desc' => $request->item_desc,
                    'item_base_unit' => $request->item_base_unit,
                    'item_conversion_rate' => $request->item_conversion_rate,
                    'item_sub_unit' => $request->item_sub_unit,
                    'item_gst' => $request->item_gst,
                    'item_purchase_rate' => $item_purchase_rate,
                    'item_purchase_tax_type' => 1,
                    'item_sale_tax_type' => 1,
                    'item_gst_slab' => $request->item_gst_slab,
                    'item_stock_whole' => $request->item_stock_whole,
                    'item_stock_retail' => 0,
                    'item_min_stock' => $request->item_min_stock,
                    'item_sale_rate_whole_base' => $item_sale_rate_whole_base,
                    'item_sale_rate_whole_sub' => $item_sale_rate_whole_sub,
                    'item_sale_rate_retail_base' => $item_sale_rate_retail_base,
                    'item_sale_rate_retail_sub' => $item_sale_rate_retail_sub,
                    'item_mfg_date' => $request->item_mfg_date,
                    'item_exp_date' => $request->item_exp_date,
                    'item_mrp' => $request->item_mrp,
                    'item_disc_whole' => $request->item_disc_whole,
                    'item_disc_retail' => $request->item_disc_retail,
                    'item_exp_alert_time' => $request->item_exp_alert_time
                ]);
            }
            $previousItems = PurchaseItem::get();
            $shouldContinue = true;
            foreach ($previousItems as $item) {
                if ($item->p_i_item_id == $mainItem->item_id && $item->p_i_p_h_id == $history->p_h_id) {
                    // $previousItemID = $item->p_i_id;
                    $result = $item->update([
                        'p_i_p_h_id' => $history->p_h_id,
                        'p_i_item_id' => $mainItem->item_id,
                        'p_i_qty' => $item->p_i_qty + $request->item_stock_whole,
                        'p_i_rate' => $request->item_purchase_rate,
                        'p_i_total' => $item->p_i_total + $request->item_total,
                    ]);
                    $shouldContinue = false;
                    break;
                }
            }
            if ($shouldContinue) {
                $result = PurchaseItem::create([
                    'p_i_p_h_id' => $history->p_h_id,
                    'p_i_item_id' => $mainItem->item_id,
                    'p_i_qty' => $request->item_stock_whole,
                    'p_i_rate' => $request->item_purchase_rate,
                    'p_i_total' => $request->item_total,
                ]);
            }
            return $result;
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchPurchaseHistory(Request $request)
    {
        if (Session::has('admin')) {
            // return response()->json($request);
            $p_i_id = $request->p_i_id;
            $itemData = PurchaseItem::find($p_i_id);
            if (!$itemData) {
                return response()->json(['status' => 'Item info not available on server!'], 400);
            }
            $purchaseHistory = PurchaseHistory::find($itemData->p_i_p_h_id);
            $partyData = PartyModel::find($purchaseHistory->p_h_party_id);
            if (!$partyData) {
                return response()->json(['status' => 'Party info not available on server!'], 400);
            }
            $item = ItemsModel::find($itemData->p_i_item_id);
            if (!$item) {
                return response()->json(['status' => 'Item info not available on server!'], 400);
            }
            return response()->json([
                'status' => true,
                'partyData' => $partyData,
                'billingData' => $purchaseHistory,
                'itemData' => $item,
                'itemQty' => $itemData->p_i_qty,
                'invtotal' => $itemData->p_i_total
            ], 200);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function deleteHistoryRecordAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $p_i_id = $request->p_h_id;
            $purchaseItem = PurchaseItem::find($p_i_id);
            if ($purchaseItem) {
                $purchaseItem->delete();
                return response()->json(true);
            } else {
                return response()->json(['status' => $request->p_h_id], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function passwordChek(Request $request)
    {
        if (Session::has('admin')) {
            $user = AdminModel::find($request->a_id);
            if ($user) {
                $old_password = $user->a_pass;
                if ($request->a_pass == $old_password) {
                    return response(['data' => '<label class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Ready to Proceed</label>']);
                } else {
                    return response(['data' => '<label class="text-danger"><i class="fa fa-info-circle" aria-hidden="true"></i> Incorrect old password</label>']);
                }
            } else {
                return redirect('/');
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function saveresetpassword(Request $request)
    {
        if (Session::has('admin')) {
            $id = $request->a_id;
            $user = AdminModel::where('a_id', $id)->first();
            $user->password = $request->new_password;
            $user->save();
            return response(['data' => 'Password updated successfully']);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    //forgot-password
    public function forgotPasswordView()
    {
        if (Session::has('admin')) {
            echo view('forgot-password');
        } else {
            echo view('login');
        }
    }

    //logout
    public function logoutView()
    {
        Auth::logout();
        Session::flush();
        return  redirect('/');
    }

    //add-new-shop
    public function addNewShopView()
    {
        if (Session::has('admin')) {
            echo view('add-new-shop');
        } else {
            echo view('login');
        }
    }

    //manage-users
    public function manageUsersView()
    {
        if (Session::has('admin')) {
            echo view('manage-users');
        } else {
            echo view('login');
        }
    }

    public function manageAccountsView()
    {
        if (Session::has('admin')) {
            echo view('manage-accounts');
        } else {
            echo view('login');
        }
    }

    //edit-sale
    public function editSaleView()
    {
        if (Session::has('admin')) {
            echo '<div style="width: 100%; height:98vh; display: flex; justify-content: center; align-items: center;" ><h1>This link is disabled by admin.</h1></div>';
        } else {
            echo view('login');
        }
    }

    //edit-purchase
    public function editPurchaseView()
    {
        if (Session::has('admin')) {
            echo view('edit-purchase');
        } else {
            echo view('login');
        }
    }

    // Get Customers
    public function getCustomers()
    {
        if (Session::has('admin')) {
            $customers = CustomerModel::get();
            if ($customers) {
                return response()->json(['status' => true, 'data' => $customers], 200);
            } else {
                return response()->json(['status' => 'Data not found!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    // Edit Customer
    public function editCustomer(Request $req)
    {
        if (Session::has('admin')) {
            $customer = CustomerModel::find($req->id);
            if ($customer) {
                return response()->json(['status' => true, 'data' => $customer], 200);
            } else {
                return response()->json(['status' => 'Customer details not available on server!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    // Fetch Base Units
    public function fetchBaseUnitsAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $baseUnits = UnitModel::get();
            if ($baseUnits) {
                return response()->json($baseUnits);
            } else {
                return response()->json(['status' => 'Please make some units before use!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchGstSlabAJAX()
    {
        if (Session::has('admin')) {
            $gstSlab = SlabModel::get();
            if ($gstSlab) {
                return response()->json($gstSlab);
            } else {
                return response()->json(['status' => 'Please make gst slab before use!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    // Save Sales Items
    public function saveSalesItemsAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $findCustomer = CustomerModel::find($req->c_id);

            if ($findCustomer) {

                $result = $findCustomer->update([
                    'c_name' => $req->c_name,
                    'c_gst' => $req->c_gst,
                    'c_add' => $req->c_add,
                    'c_fmob' => $req->c_fmob,
                    'c_smob' => $req->c_smob,
                    'c_state' => $req->c_state,
                    'c_desc' => $req->c_desc,
                    'c_dues' => $req->s_h_due
                ]);

                if (!$result) {
                    return response()->json(['status' => 'Error in updating customer info!'], 200);
                }

                $salesHistoryResult = SalesHistory::where('s_h_otp', '=', $req->p_h_otp)->first();
                if ($salesHistoryResult) {
                    $salesHistoryResult->update([
                        's_h_otp' => $req->p_h_otp,
                        's_h_customer_id' => $findCustomer->c_id,
                        's_h_bill_date' => $req->billDate,
                        's_h_customer_type' => $req->custType,
                        's_h_bill_type' => $req->billType,
                        's_h_bill_desc' => $req->s_h_bill_desc,
                        's_h_pre' => $req->c_dues,
                        's_h_grand' => $req->s_h_grand,
                        's_h_total' => $req->s_h_total,
                        's_h_dis' => $req->s_h_dis,
                        's_h_other' => $req->s_h_other,
                        's_h_due' => $req->s_h_due,
                        's_h_paid' => $req->s_h_paid,
                    ]);
                } else {
                    $billNo = 'BE' . rand(111111111, 999999999);
                    while (SalesHistory::where('s_h_bill_no', $billNo)->exists()) {
                        $billNo = 'BE' . rand(111111111, 999999999);
                    }
                    $salesHistoryResult = SalesHistory::create([
                        's_h_otp' => $req->p_h_otp,
                        's_h_customer_id' => $findCustomer->c_id,
                        's_h_bill_no' => $billNo,
                        's_h_bill_date' => $req->billDate,
                        's_h_customer_type' => $req->custType,
                        's_h_bill_type' => $req->billType,
                        's_h_bill_desc' => $req->s_h_bill_desc,
                        's_h_pre' => $req->c_dues,
                        's_h_grand' => $req->s_h_grand,
                        's_h_total' => $req->s_h_total,
                        's_h_dis' => $req->s_h_dis,
                        's_h_other' => $req->s_h_other,
                        's_h_due' => $req->s_h_due,
                        's_h_paid' => $req->s_h_paid,
                    ]);
                }


                $item = ItemsModel::find($req->item_id);
                if ($item && $salesHistoryResult) {
                    if ($req->btnType == 1) {
                        $test = SalesItems::where('s_i_s_h_id', '=', $salesHistoryResult->id)
                            ->where('s_i_item_id', '=', $req->item_id)
                            ->where('s_i_qty', '=', $req->s_h_qty)
                            ->where('s_i_rate', '=', $req->item_rate)
                            ->where('s_i_total', '=', $req->amount)
                            ->first();
                        if ($test) {
                            $salesItemResult = true;
                        } else {
                            $item->update([
                                'item_stock_whole' => $req->stock
                            ]);
                            if ($req->custType == 1) {
                                $salesItemResult = SalesItems::create([
                                    's_i_s_h_id' => $salesHistoryResult->s_h_id,
                                    's_i_item_id' => $req->item_id,
                                    's_i_qty' => $req->s_h_qty,
                                    's_i_rate' => $item->item_sale_rate_whole_base,
                                    's_i_total' => $req->amount
                                ]);
                            } else {
                                $salesItemResult = SalesItems::create([
                                    's_i_s_h_id' => $salesHistoryResult->s_h_id,
                                    's_i_item_id' => $req->item_id,
                                    's_i_qty' => $req->s_h_qty,
                                    's_i_rate' => $item->item_sale_rate_retail_base,
                                    's_i_total' => $req->amount
                                ]);
                            }
                        }
                    } else {
                        $item->update([
                            'item_stock_whole' => $req->stock
                        ]);
                        if ($req->custType == 1) {
                            $salesItemResult = SalesItems::create([
                                's_i_s_h_id' => $salesHistoryResult->s_h_id,
                                's_i_item_id' => $req->item_id,
                                's_i_qty' => $req->s_h_qty,
                                's_i_rate' => $item->item_sale_rate_whole_base,
                                's_i_total' => $req->amount
                            ]);
                        } else {
                            $salesItemResult = SalesItems::create([
                                's_i_s_h_id' => $salesHistoryResult->s_h_id,
                                's_i_item_id' => $req->item_id,
                                's_i_qty' => $req->s_h_qty,
                                's_i_rate' => $item->item_sale_rate_retail_base,
                                's_i_total' => $req->amount
                            ]);
                        }
                    }
                    if (!$salesItemResult) {
                        return response()->json(['status' => 'Error in saving Sales Items!'], 400);
                        // return response()->json(['status' => $salesItemResult], 400);
                    } else {
                        $data = array_merge($salesHistoryResult->toArray(), $item->toArray(), $findCustomer->toArray());
                        return response()->json(['status' => true, 'data' => $data], 200);
                    }
                } else {
                    if (!$item) {
                        return response()->json(['status' => 'Item not available!'], 400);
                    }
                    if (!$salesHistoryResult) {
                        return response()->json(['status' => 'Error in saving Sales History!'], 400);
                    }
                }
            } else {
                $newCustomer = CustomerModel::create([
                    'c_name' => $req->c_name,
                    'c_gst' => $req->c_gst,
                    'c_add' => $req->c_add,
                    'c_fmob' => $req->c_fmob,
                    'c_smob' => $req->c_smob,
                    'c_state' => $req->c_state,
                    'c_desc' => $req->c_desc,
                    'c_dues' => $req->s_h_due
                ]);

                $billNo = 'BE' . rand(111111111, 999999999);
                while (SalesHistory::where('s_h_bill_no', $billNo)->exists()) {
                    $billNo = 'BE' . rand(111111111, 999999999);
                }

                if ($newCustomer) {
                    $salesHistoryResult = SalesHistory::create([
                        's_h_otp' => $req->p_h_otp,
                        's_h_customer_id' => $newCustomer->c_id,
                        's_h_bill_no' => $billNo,
                        's_h_bill_date' => $req->billDate,
                        's_h_customer_type' => $req->custType,
                        's_h_bill_type' => $req->billType,
                        's_h_bill_desc' => $req->s_h_bill_desc,
                        's_h_pre' => $req->c_dues,
                        's_h_grand' => $req->s_h_grand,
                        's_h_total' => $req->s_h_total,
                        's_h_dis' => $req->s_h_dis,
                        's_h_other' => $req->s_h_other,
                        's_h_due' => $req->s_h_due,
                        's_h_paid' => $req->s_h_paid,
                    ]);

                    $item = ItemsModel::find($req->item_id);
                    $salesItemResult = false;
                    if ($item && $salesHistoryResult) {
                        if ($req->btnType == 1) {
                            $test = SalesItems::where('s_i_s_h_id', '=', $salesHistoryResult->id)
                                ->where('s_i_item_id', '=', $req->item_id)
                                ->where('s_i_qty', '=', $req->s_h_qty)
                                ->where('s_i_rate', '=', $req->item_rate)
                                ->where('s_i_total', '=', $req->amount)
                                ->first();
                            if ($test) {
                                $salesItemResult = $test;
                            } else {
                                $item->update([
                                    'item_stock_whole' => $req->stock
                                ]);
                                if ($req->custType == 1) {
                                    $salesItemResult = SalesItems::create([
                                        's_i_s_h_id' => $salesHistoryResult->s_h_id,
                                        's_i_item_id' => $req->item_id,
                                        's_i_qty' => $req->s_h_qty,
                                        's_i_rate' => $item->item_sale_rate_whole_base,
                                        's_i_total' => $req->amount
                                    ]);
                                } else {
                                    $salesItemResult = SalesItems::create([
                                        's_i_s_h_id' => $salesHistoryResult->s_h_id,
                                        's_i_item_id' => $req->item_id,
                                        's_i_qty' => $req->s_h_qty,
                                        's_i_rate' => $item->item_sale_rate_retail_base,
                                        's_i_total' => $req->amount
                                    ]);
                                }
                            }
                        } else {
                            $item->update([
                                'item_stock_whole' => $req->stock
                            ]);
                            if ($req->custType == 1) {
                                $salesItemResult = SalesItems::create([
                                    's_i_s_h_id' => $salesHistoryResult->s_h_id,
                                    's_i_item_id' => $req->item_id,
                                    's_i_qty' => $req->s_h_qty,
                                    's_i_rate' => $item->item_sale_rate_whole_base,
                                    's_i_total' => $req->amount
                                ]);
                            } else {
                                $salesItemResult = SalesItems::create([
                                    's_i_s_h_id' => $salesHistoryResult->s_h_id,
                                    's_i_item_id' => $req->item_id,
                                    's_i_qty' => $req->s_h_qty,
                                    's_i_rate' => $item->item_sale_rate_retail_base,
                                    's_i_total' => $req->amount
                                ]);
                            }
                        }
                        if (!$salesItemResult) {
                            return response()->json(['status' => 'Error in saving Sales Items!'], 400);
                        } else {
                            $data = array_merge($salesHistoryResult->toArray(), $item->toArray(), $newCustomer->toArray(), $salesItemResult->toArray());
                            return response()->json(['status' => true, 'data' => $data], 200);
                        }
                    } else {
                        if (!$item) {
                            return response()->json(['status' => 'Item not available!'], 400);
                        }
                        if (!$salesHistoryResult) {
                            return response()->json(['status' => 'Error in saving Sales History!'], 400);
                        }
                    }
                } else {
                    return response()->json(['status' => 'Error in saving new customer record!'], 400);
                }
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchItemStockAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $item = ItemsModel::find($req->id);
            if ($item) {
                return response()->json($item->item_stock_whole);
            } else {
                return response()->json(['status' => 'Error in getting item stock!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function generateInvoice(Request $request, $otp, $billfor, $type)
    {
        if (Session::has('admin')) {
            $historyID = SalesHistory::where('s_h_otp', '=', $otp)->first();
            if ($billfor == 'salesentry' && $type == 'gst') {
                $result = SalesHistory::join('sales_items', 'sales_items.s_i_s_h_id', '=', 'sales_history.s_h_id')
                    ->join('items', 'items.item_id', '=', 'sales_items.s_i_item_id')
                    ->where('sales_history.s_h_otp', '=', $otp)
                    ->get(['sales_items.*', 'sales_history.*', 'items.*']);

                $customer = CustomerModel::find($historyID->s_h_customer_id);
                $uniqueItemHsns = $result->pluck('item_hsn')->unique()->toArray();
                $items = [];
                foreach ($uniqueItemHsns as $hsn) {
                    $temp = ItemsModel::where('item_hsn', '=', $hsn)->orderBy('item_id', 'desc')->get()->toArray();
                    $items = array_merge($temp, $items);
                }
                $items = array_reverse($items);
                $state = StateModel::get();
                $unit = UnitModel::get();
                $slab = SlabModel::get();
                $admin = AdminModel::find(1);
                $newSelling = SalesItems::where('s_i_s_h_id', '=', $historyID->s_h_id)->where('s_i_item_id', '=', 0)->get();
                // return response()->json($result);
                return view('invoice', compact('result', 'customer', 'state', 'unit', 'slab', 'admin', 'items', 'billfor', 'newSelling', 'historyID'));
            } else if ($billfor == 'salesentry' && $type == 'nongst') {
                $result = SalesHistory::join('sales_items', 'sales_items.s_i_s_h_id', '=', 'sales_history.s_h_id')
                    ->join('items', 'items.item_id', '=', 'sales_items.s_i_item_id')
                    ->where('sales_history.s_h_otp', '=', $otp)
                    ->get(['sales_items.*', 'sales_history.*', 'items.*']);
                $c_id = $result->pluck('s_h_customer_id')->unique();
                $s_h_id = $result->pluck('s_i_s_h_id')->unique();
                $newSelling = SalesItems::where('s_i_s_h_id', '=', $historyID->s_h_id)->where('s_i_item_id', '=', 0)->get();
                $customer = CustomerModel::find($historyID->s_h_customer_id);
                // return response()->json($result);
                return view('nongstinvoice', compact('result', 'customer', 'newSelling', 'historyID'));
            } else {
                echo 'You crashed the server! :-(';
            }
        } else {
            echo view('login');
        }
    }

    public function removeItemForGenerateInvoiceAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $history = SalesHistory::where('s_h_otp', '=', $req->otp)->first();
            if ($history) {
                $saleItem = SalesItems::where('s_i_s_h_id', '=', $history->s_h_id)
                    ->where('s_i_item_id', '=', $req->item_id)
                    ->where('s_i_qty', '=', $req->s_h_qty)
                    ->where('s_i_rate', '=', $req->item_rate)
                    ->where('s_i_total', '=', $req->amount)
                    ->first();
                if ($saleItem) {
                    $item = ItemsModel::find($req->item_id);

                    $item->item_stock_whole = $item->item_stock_whole + $req->s_h_qty;
                    $item->save();

                    $customer = CustomerModel::find($history->s_h_customer_id);

                    $customer->c_dues = $customer->c_dues - $req->amount;
                    $customer->save();

                    $history->s_h_due = $history->s_h_due - $req->amount;
                    $history->s_h_grand = $history->s_h_grand - $req->amount;
                    $history->s_h_total = $history->s_h_total - $req->amount;
                    $history->save();

                    if (SalesItems::destroy($saleItem->s_i_id)) {
                        return response()->json(['status' => true, 'msg' => false]);
                    } else {
                        return response()->json(['status' => false, 'msg' => true, 'remark' => 'Item not deleted successfully!']);
                    }
                } else {
                    return response()->json(['status' => false, 'msg' => true, 'remark' => 'No previous history found!']);
                }
            } else {
                return response()->json(['status' => true, 'msg' => true, 'remark' => 'No previous history found!']);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchKhatabookListAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $customer = CustomerModel::get();
            return response()->json(['status' => true, 'data' => $customer]);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function saveNewCustomerAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $req->validate([
                'c_name' => 'required',
                'c_type' => 'required|numeric',
                'c_fmob' => 'required|numeric|regex:/^\d{10}$/',
                'c_gst' => 'required',
                'c_state' => 'required|numeric',
                'c_add' => 'required',
                'c_dues' => 'required|numeric'
            ], [
                'c_name.required' => 'Customer name is required!',
                'c_type.required' => 'Customer type is required!',
                'c_type.numeric' => 'Invalid customer type!',
                'c_fmob.required' => 'Mobile number is required!',
                'c_fmob.regex' => 'Invalid mobile number length!',
                'c_fmob.numeric' => 'Invalid mobile number!',
                'c_gst.required' => 'G.S.T number is required!',
                'c_state.required' => 'State is required!',
                'c_state.numeric' => 'Invalid state!',
                'c_add.required' => 'Address is required!',
                'c_dues.required' => 'Dues amount is required!',
                'c_dues.numeric' => 'Invalid dues amount!',
            ]);
            // return response()->json($req->c_type);
            $type = (int)$req->c_type;
            $result = CustomerModel::create([
                'c_name' => $req->c_name,
                'c_type' => $type,
                'c_gst' => $req->c_gst,
                'c_add' => $req->c_add,
                'c_fmob' => $req->c_fmob,
                'c_smob' => $req->c_smob,
                'c_state' => $req->c_state,
                'c_desc' => $req->c_desc,
                'c_dues' => $req->c_dues,
                'c_status' => 1,
                'c_deleted_by' => 0
            ]);
            if ($result) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchPurchaseEntriesAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $list = [];
            $purchaseHistories = PurchaseHistory::get();
            foreach ($purchaseHistories as $history) {
                $party = PartyModel::find($history->p_h_party_id);
                $list[] = array_merge($history->toArray(), $party->toArray());
            }
            return response()->json($list);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function editPurchaseHistoryIdAJAX($historyId)
    {
        if (Session::has('admin')) {
            $units = UnitModel::where('u_status', '=', 0)->get();
            $slab = SlabModel::get();
            $history = PurchaseHistory::find($historyId);
            $purchaseitems = PurchaseItem::where('p_i_p_h_id', '=', $historyId)->orderBy('p_i_id', 'desc')->get();
            $pItems = [];
            foreach ($purchaseitems as $purchItem) {
                $item = ItemsModel::find($purchItem->p_i_item_id);
                $pItems[] = array_merge($purchItem->toArray(), $item->toArray());
            }
            $party = PartyModel::find($history->p_h_party_id);
            $state = StateModel::find($party->p_state);

            $itemIds = $purchaseitems->pluck('p_i_item_id')->unique()->toArray();
            $items = [];
            foreach ($itemIds as $id) {
                $item = ItemsModel::find($id);
                $items[] = $item->toArray();
            }

            // return response()->json($pItems);
            echo view('purchase_entry_data', compact('units', 'slab', 'history', 'pItems', 'party', 'items', 'state'));
        } else {
            echo view('login');
        }
    }

    public function deletePurchaseHistoryIdAJAX($historyId)
    {
        if (Session::has('admin')) {
            $history = PurchaseHistory::find($historyId);
            if ($history) {
                try {
                    PurchaseItem::where('p_i_p_h_id', '=', $history->p_h_id)->delete();
                    $history->delete();
                    return redirect()->back()->with('status', ['success' => true]);
                } catch (\Exception $e) {
                    return redirect()->back()->with('status', ['success' => false, 'error' => $e->getMessage()]);
                }
            } else {
                return redirect()->back()->with('status', ['success' => false, 'error' => 'Purchase history not found']);
            }
        } else {
            echo view('login');
        }
    }

    public function fetchSalesEntriesAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $salesHistories = SalesHistory::get();
            $data = [];
            foreach ($salesHistories as $history) {
                $customer = CustomerModel::find($history->s_h_customer_id);
                $data[] = array_merge($history->toArray(), $customer->toArray());
            }
            return response()->json($data);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function editSaleHistoryIdAJAX($historyId)
    {
        if (Session::has('admin')) {
            $history = SalesHistory::find($historyId);
            $sItems = SalesItems::where('s_i_s_h_id', '=', $historyId)->get();
            $saleItems = [];
            foreach ($sItems as $sale) {
                $item = ItemsModel::find($sale->s_i_item_id);
                $saleItems[] = array_merge($sale->toArray(), $item->toArray());
            }
            if ($history) {
                $customer = CustomerModel::find($history->s_h_customer_id);
                $state = StateModel::find($customer->c_state);
            } else {
            }
            // return response()->json($saleItems);
            echo view('edit-sale', compact('history', 'customer', 'saleItems', 'state'));
        } else {
            echo view('login');
        }
    }

    public function fetchcustomersListAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $customer = CustomerModel::get();
            return response()->json($customer);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchCustomerDataAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $id = $request->c_id;
            $customer = CustomerModel::find($id);
            if ($customer) {
                return response()->json($customer);
            } else {
                return response()->json(['status' => 'Customer not found!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function updateCustomerDataAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $id = $request->c_id;
            $customer = CustomerModel::find($id);
            if ($customer) {
                $result = $customer->update([
                    'c_name' => $request->c_name,
                    'c_type' => $request->c_type,
                    'c_fmob' => $request->c_fmob,
                    'c_smob' => $request->c_smob,
                    'c_gst' => $request->c_gst,
                    'c_state' => $request->c_state,
                    'c_add' => $request->c_add,
                    'c_desc' => $request->c_desc,
                    'c_dues' => $request->c_dues,
                ]);
                if ($result) {
                    return response()->json(true);
                }
            }
            return response()->json(false);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function deleteCustomerDataAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $id = $request->c_id;
            $customer = CustomerModel::find($id);
            if ($customer) {
                $result = $customer->delete();
                if ($result) {
                    return response()->json(true);
                }
            }
            return response()->json(false);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function makeNewAccountAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $request->validate([
                'ac_name' => 'required|string',
                'ac_balance' => 'required|integer'
            ], [
                'ac_name.required' => 'Account name is required!',
                'ac_name.string' => 'Invalid account name!',
                'ac_balance.required' => 'Account balance is required!',
                'ac_balance.integer' => 'Invalid account balance!'
            ]);
            $result = Account::create([
                'ac_name' => $request->ac_name,
                'ac_balance' => $request->ac_balance
            ]);
            if ($result) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchAccountsInfoAJAX()
    {
        if (Session::has('admin')) {
            $accounts = Account::get();
            if ($accounts) {
                return response()->json($accounts);
            } else {
                return response()->json(['status' => 'Need to create some accounts now!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchAccountInfoAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $id = $request->ac_id;
            $account = Account::find($id);
            if ($account) {
                return response()->json($account);
            } else {
                return response()->json(['message' => 'Account not found on server!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function deleteAccountInfoAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $id = $request->ac_id;
            $account = Account::find($id);
            if ($account) {
                $result = $account->delete();
                if ($result) {
                    return response()->json(true);
                } else {
                    return response()->json(['message' => 'Error in deleting account!'], 400);
                }
            }
            return response()->json(['message' => 'Account not found!'], 400);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function updateAccountInfoAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $request->validate([
                'ac_id' => 'required|integer',
                'ac_name' => 'required|string',
                'ac_balance' => 'required|integer',
            ], [
                'ac_id.required' => 'Account id is required!',
                'ac_id.integer' => 'Invalid account id!',
                'ac_name.required' => 'Account name is required!',
                'ac_name.string' => 'Invalid account name!',
                'ac_balance.required' => 'Account balance is required!',
                'ac_balance.integer' => 'Invalid account balance!'
            ]);
            $id = $request->ac_id;
            $account = Account::find($id);
            if ($account) {
                $result = $account->update([
                    'ac_name' => $request->ac_name,
                    'ac_balance' => $request->ac_balance
                ]);
                if ($result) {
                    return response()->json(true);
                } else {
                    return response()->json(['message' => 'Error in updating account info!'], 400);
                }
            } else {
                return response()->json(['message' => 'Account not found!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function makeTransactionAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $id = $request->ac_id;
            $account = Account::find($id);
            if ($account) {
                $request->validate([
                    't_amount' => 'required|integer',
                    't_remark' => 'required|string',
                    't_type' => 'required|integer',
                    't_date' => 'required'
                ], [
                    't_amount.required' => 'Amount is required!',
                    't_amount.integer' => 'Invalid amount given!',
                    't_remark.required' => 'Remarks is required!',
                    't_remark.string' => 'Invalid remark found!',
                    't_type.required' => 'Type is required!',
                    't_type.integer' => 'Invalid type found!',
                    't_date.required' => 'Date is required!'
                ]);
                if ($request->t_type == 1) {
                    $account->ac_balance += $request->t_amount;
                    if (!$account->save()) {
                        return response()->json(['message' => 'Error while updating account record!'], 400);
                    }
                } else if ($request->t_type == 2) {
                    $account->ac_balance -= $request->t_amount;
                    if (!$account->save()) {
                        return response()->json(['message' => 'Error while updating account record!'], 400);
                    }
                }
                $result = Transaction::create([
                    't_ac_id' => $id,
                    't_type' => $request->t_type,
                    't_amount' => $request->t_amount,
                    't_final_amount' => $account->ac_balance,
                    't_remarks' => $request->t_remark,
                    't_date' => $request->t_date
                ]);
                if ($result) {
                    return response()->json(true);
                } else {
                    return response()->json(['message' => 'Error while creating transaction record!'], 400);
                }
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!!'], 400);
        }
    }

    public function fetchPartiesListAJAX()
    {
        if (Session::has('admin')) {
            return response()->json(PartyModel::get());
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function saveNewPartyAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $req->validate([
                'p_name' => 'required',
                'p_type' => 'required|numeric',
                'p_fmob' => 'required|numeric|regex:/^\d{10}$/',
                'p_gst' => 'required',
                'p_state' => 'required|numeric',
                'p_add' => 'required',
                'p_dues' => 'required|numeric'
            ], [
                'p_name.required' => 'Customer name is required!',
                'p_type.required' => 'Customer type is required!',
                'p_type.numeric' => 'Invalid customer type!',
                'p_fmob.required' => 'Mobile number is required!',
                'p_fmob.regex' => 'Invalid mobile number length!',
                'p_fmob.numeric' => 'Invalid mobile number!',
                'p_gst.required' => 'G.S.T number is required!',
                'p_state.required' => 'State is required!',
                'p_state.numeric' => 'Invalid state!',
                'p_add.required' => 'Address is required!',
                'p_dues.required' => 'Dues amount is required!',
                'p_dues.numeric' => 'Invalid dues amount!',
            ]);
            $result = PartyModel::create([
                'p_name' => $req->p_name,
                'p_type' => $req->p_type,
                'p_gst' => $req->p_gst,
                'p_add' => $req->p_add,
                'p_fmob' => $req->p_fmob,
                'p_smob' => $req->p_smob,
                'p_state' => $req->p_state,
                'p_desc' => $req->p_desc,
                'p_dues' => $req->p_dues
            ]);
            if ($result) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function deletePartyAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $id = $req->p_id;
            $party = PartyModel::find($id);
            $purchaseHistories = PurchaseHistory::where('p_h_party_id', $id)->get();

            foreach ($purchaseHistories as $purchaseHistory) {
                $purchaseHistory->delete();
            }
            if ($party->delete()) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchItemsDataAJAX(Request $req)
    {
        if (Session::has('admin')) {
            // return response()->json($req);
            if ($req->type == 1) {
                $items = ItemsModel::where('item_purchase_tax_type', '=', 1)->get();
            } else {
                $items = ItemsModel::get();
            }
            return response()->json($items);
        } else {
            return response()->json(['message', 'You should reload the page now!'], 400);
        }
    }

    public function saveSaleDataAJAX(Request $req)
    {
        if (Session::has('admin')) {
            // return response()->json($req);
            $salesHistory = SalesHistory::where('s_h_otp', $req->p_h_otp)->first();
            $customer = CustomerModel::find($req->c_id);
            if ($customer) {
                $customer->update([
                    'c_type' => $req->custType,
                    'c_name' => $req->c_name,
                    'c_fmob' => $req->c_fmob,
                    'c_smob' => $req->c_smob,
                    'c_gst' => $req->c_gst,
                    'c_state' => $req->c_state,
                    'c_add' => $req->c_add,
                    'c_dues' => $req->s_h_due,
                    'c_desc' => $req->c_desc
                ]);
            } else {
                $customer = CustomerModel::create([
                    'c_type' => $req->custType,
                    'c_name' => $req->c_name,
                    'c_fmob' => $req->c_fmob,
                    'c_smob' => $req->c_smob,
                    'c_gst' => $req->c_gst,
                    'c_state' => $req->c_state,
                    'c_add' => $req->c_add,
                    'c_dues' => $req->s_h_due,
                    'c_desc' => $req->c_desc
                ]);
            }
            if ($salesHistory) {
                $salesHistory->update([
                    's_h_customer_id' => $customer->c_id,
                    's_h_bill_desc' => $req->s_h_bill_desc,
                    's_h_bill_type' => $req->billType,
                    's_h_bill_date' => $req->billDate,
                    's_h_paid' => $req->s_h_paid,
                    's_h_pre' => $req->c_dues,
                    's_h_grand' => $req->s_h_grand,
                    's_h_customer_type' => $req->custType,
                    's_h_total' => $req->s_h_total,
                    's_h_dis' => $req->s_h_dis,
                    's_h_other' => $req->s_h_other,
                    's_h_due' => $req->s_h_due,
                    's_h_status' => 1,
                    's_h_deleted_by' => 0
                ]);
            } else {
                $billNo = 'BE' . rand(111111111, 999999999);
                while (SalesHistory::where('s_h_bill_no', $billNo)->exists()) {
                    $billNo = 'BE' . rand(111111111, 999999999);
                }
                $salesHistory = SalesHistory::create([
                    's_h_otp' => $req->p_h_otp,
                    's_h_customer_id' => $customer->c_id,
                    's_h_bill_no' => $billNo,
                    's_h_bill_desc' => $req->s_h_bill_desc,
                    's_h_bill_type' => $req->billType,
                    's_h_bill_date' => $req->billDate,
                    's_h_paid' => $req->s_h_paid,
                    's_h_pre' => $req->c_dues,
                    's_h_grand' => $req->s_h_grand,
                    's_h_customer_type' => $req->custType,
                    's_h_total' => $req->s_h_total,
                    's_h_dis' => $req->s_h_dis,
                    's_h_other' => $req->s_h_other,
                    's_h_due' => $req->s_h_due,
                    's_h_status' => 1,
                    's_h_deleted_by' => 0
                ]);
            }
            $item = ItemsModel::find($req->item_id);
            $saleItem = SalesItems::find($req->p_i_id);
            if ($item) {
                if ($req->base_unit == $item->item_base_unit) {
                    // $item->item_stock_retail = $req->stock%$item->item_conversion_rate;
                    $item->item_stock_whole = $req->stock;
                    $item->save();
                    if ($item->item_name == $req->item_name) {
                        if ($saleItem) {
                            $saleItem->update([
                                's_i_s_h_id' => $salesHistory->s_h_id,
                                's_i_item_id' => $item->item_id,
                                's_i_qty' => $req->item_qty,
                                's_i_rate' => $item->item_rate,
                                's_i_total' => $req->amount,
                                's_i_unit' => 1,
                                's_i_status' => 1,
                                's_i_item_name' => $req->item_name,
                                's_i_discount' => $req->item_discount,
                                's_i_tax' => $req->gstslab,
                                's_i_unit_new' => $req->base_unit

                            ]);
                        } else {
                            $saleItem = SalesItems::create([
                                's_i_s_h_id' => $salesHistory->s_h_id,
                                's_i_item_id' => $item->item_id,
                                's_i_qty' => $req->item_qty,
                                's_i_rate' => $req->item_rate,
                                's_i_total' => $req->amount,
                                's_i_unit' => 1,
                                's_i_status' => 1,
                                's_i_item_name' => $req->item_name,
                                's_i_discount' => $req->item_discount,
                                's_i_tax' => $req->gstslab,
                                's_i_unit_new' => $req->base_unit
                            ]);
                        }
                    } else {
                        if ($saleItem) {
                            $saleItem->update([
                                's_i_s_h_id' => $salesHistory->s_h_id,
                                's_i_item_id' => 0,
                                's_i_item_name' => $item->item_name,
                                's_i_qty' => $req->item_qty,
                                's_i_rate' => $req->item_rate,
                                's_i_total' => $req->amount,
                                's_i_unit' => 1,
                                's_i_status' => 1,
                                's_i_item_name' => $req->item_name,
                                's_i_discount' => $req->item_discount,
                                's_i_tax' => $req->gstslab,
                                's_i_unit_new' => $req->base_unit
                            ]);
                        } else {
                            $saleItem = SalesItems::create([
                                's_i_s_h_id' => $salesHistory->s_h_id,
                                's_i_item_id' => 0,
                                's_i_item_name' => $req->item_name,
                                's_i_qty' => $req->item_qty,
                                's_i_rate' => $req->item_rate,
                                's_i_total' => $req->amount,
                                's_i_unit' => 1,
                                's_i_status' => 1,
                                's_i_item_name' => $req->item_name,
                                's_i_discount' => $req->item_discount,
                                's_i_tax' => $req->gstslab,
                                's_i_unit_new' => $req->base_unit
                            ]);
                        }
                    }
                } else if ($req->base_unit == $item->item_sub_unit) {
                    // $totalStock = (($req->item_stock_whole * $item->item_conversion_rate) - $req->stock)/100;
                    // $totalStock = (($req->item_stock_whole * $item->item_conversion_rate) + $req->item_stock_retail);

                    $retailStock = $req->stock % $item->item_conversion_rate;
                    $wholeStock = ($req->stock - $retailStock) / $item->item_conversion_rate;

                    $item->item_stock_whole = $wholeStock;
                    $item->item_stock_retail = $retailStock;
                    $item->save();
                    if ($item->item_name == $req->item_name) {
                        if ($saleItem) {
                            $saleItem->update([
                                's_i_s_h_id' => $salesHistory->s_h_id,
                                's_i_item_id' => $item->item_id,
                                's_i_qty' => $req->item_qty,
                                's_i_rate' => $req->item_rate,
                                's_i_total' => $req->amount,
                                's_i_unit' => 2,
                                's_i_status' => 1,
                                's_i_item_name' => $req->item_name,
                                's_i_discount' => $req->item_discount,
                                's_i_tax' => $req->gstslab,
                                's_i_unit_new' => $req->base_unit
                            ]);
                        } else {
                            $saleItem = SalesItems::create([
                                's_i_s_h_id' => $salesHistory->s_h_id,
                                's_i_item_id' => $item->item_id,
                                's_i_qty' => $req->item_qty,
                                's_i_rate' => $req->item_rate,
                                's_i_total' => $req->amount,
                                's_i_unit' => 2,
                                's_i_status' => 1,
                                's_i_item_name' => $req->item_name,
                                's_i_discount' => $req->item_discount,
                                's_i_tax' => $req->gstslab,
                                's_i_unit_new' => $req->base_unit
                            ]);
                        }
                    } else {
                        if ($saleItem) {
                            $saleItem->update([
                                's_i_s_h_id' => $salesHistory->s_h_id,
                                's_i_item_id' => 0,
                                's_i_qty' => $req->item_qty,
                                's_i_rate' => $req->item_rate,
                                's_i_total' => $req->amount,
                                's_i_unit' => 2,
                                's_i_status' => 1,
                                's_i_item_name' => $req->item_name,
                                's_i_discount' => $req->item_discount,
                                's_i_tax' => $req->gstslab,
                                's_i_unit_new' => $req->base_unit
                            ]);
                        } else {
                            $saleItem = SalesItems::create([
                                's_i_s_h_id' => $salesHistory->s_h_id,
                                's_i_item_id' => 0,
                                's_i_qty' => $req->item_qty,
                                's_i_rate' => $req->item_rate,
                                's_i_total' => $req->amount,
                                's_i_unit' => 2,
                                's_i_status' => 1,
                                's_i_item_name' => $req->item_name,
                                's_i_discount' => $req->item_discount,
                                's_i_tax' => $req->gstslab,
                                's_i_unit_new' => $req->base_unit
                            ]);
                        }
                    }
                }
            } else {
                if ($saleItem) {
                    $saleItem->update([
                        's_i_s_h_id' => $salesHistory->s_h_id,
                        's_i_item_id' => 0,
                        's_i_qty' => $req->item_qty,
                        's_i_rate' => $req->item_rate,
                        's_i_total' => $req->amount,
                        's_i_unit' => 0,
                        's_i_status' => 1,
                        's_i_item_name' => $req->item_name,
                        's_i_discount' => $req->item_discount,
                        's_i_tax' => $req->gstslab,
                        's_i_unit_new' => $req->base_unit
                    ]);
                } else {
                    $saleItem = SalesItems::create([
                        's_i_s_h_id' => $salesHistory->s_h_id,
                        's_i_item_id' => 0,
                        's_i_qty' => $req->item_qty,
                        's_i_rate' => $req->item_rate,
                        's_i_total' => $req->amount,
                        's_i_unit' => 0,
                        's_i_status' => 1,
                        's_i_item_name' => $req->item_name,
                        's_i_discount' => $req->item_discount,
                        's_i_tax' => $req->gstslab,
                        's_i_unit_new' => $req->base_unit
                    ]);
                }
            }
            if ($item) {
                return response()->json(['c_id' => $customer->c_id, 'p_i_id' => $saleItem->s_i_id, 'remStock' => $item->item_stock_whole + $req->item_qty]);
            } else {
                return response()->json(['c_id' => $customer->c_id, 'p_i_id' => $saleItem->s_i_id, 'remStock' => -$req->qty]);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function deleteSaleDataAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $s_i_id = $req->id;
            $s_h_otp = $req->otp;
            $salesHistory = SalesHistory::where('s_h_otp', '=', $s_h_otp)->first();
            $saleItem = SalesItems::find($req->id);
            // return response()->json($req);
            if ($saleItem) {
                if ($saleItem->s_i_s_h_id == $salesHistory->s_h_id) {
                    $salesHistory->s_h_grand = $salesHistory->s_h_grand - $saleItem->s_i_total;
                    $salesHistory->s_h_total = $salesHistory->s_h_total - $saleItem->s_i_total;
                    $salesHistory->s_h_due = $salesHistory->s_h_due - $saleItem->s_i_total;
                    $salesHistory->save();

                    $customer = CustomerModel::find($salesHistory->s_h_customer_id);
                    $customer->c_dues = $customer->c_dues - $saleItem->s_i_total;
                    $customer->save();

                    $item = ItemsModel::find($saleItem->s_i_item_id);
                    if ($item) {
                        if ($saleItem->unit == 1) {
                            $item->item_stock_whole = $item->item_stock_whole + $saleItem->s_i_qty;
                            $item->save();
                        } else {
                            $retailStock = ($item->item_stock_whole * $item->item_conversion_rate) + $item->item_stock_retail;
                            $calculatedRetailStock = $retailStock + $saleItem->s_i_qty;

                            $finalStockRetail = $calculatedRetailStock % $item->item_conversion_rate;
                            $finalStockWhole = ($calculatedRetailStock - $saleItem->s_i_qty) / $item->item_conversion_rate;

                            $item->item_stock_whole = $finalStockWhole;
                            $item->item_stock_retail = $finalStockRetail;
                            $item->save();
                        }
                    }

                    $saleItem->delete();
                }
            }
        } else {
            echo view('login');
        }
    }

    public function fetchStockDataAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $item = ItemsModel::find($req->id);
            return response()->json($item->item_stock_whole);
        } else {
            return response()->json(['message', 'You should reload the page now!'], 400);
        }
    }

    public function oldQtyUnitAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $item = ItemsModel::find($req->id);
            $saleItem = SalesItems::find($req->p_i_id);
            return response()->json([
                'newstockwhole' => $item->item_stock_whole,
                'newstockretail' => $item->item_stock_retail,
                's_i_unit' => $saleItem->s_i_unit,
                's_i_qty' => $saleItem->s_i_qty
            ]);
        } else {
            return response()->json(['message', 'You should reload the page now!'], 400);
        }
    }

    public function fetchCustomerRecordAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $customer = CustomerModel::find($req->c_id);
            return response()->json($customer);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchAccountListAJAX()
    {
        if (Session::has('admin')) {
            $acc = Account::get();
            return response()->json($acc);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function saveUserTransactionAJAX(Request $req)
    {
        if (Session::has('admin')) {
            // return response()->json($req);
            if ($req->tnx_user_type == 1) {
                $user = CustomerModel::find($req->tnx_user_id);
                $username = $user->c_name;
            } else if ($req->tnx_user_type == 2) {
                $user = PartyModel::find($req->tnx_user_id);
                $username = $user->p_name;
            } else {
                return response()->json(['message' => 'User type error!'], 400);
            }

            $account = Account::find($req->tnx_account);

            if ($account) {
                if ($req->tnx_user_type == 1) {
                    $preDues = $user->c_dues;
                } else if ($req->tnx_user_type == 2) {
                    $preDues = $user->p_dues;
                }
                if ($req->tnx_type == 1) {
                    $finalDues = $preDues - $req->tnx_amount;
                    $account->ac_balance = $account->ac_balance + $req->tnx_amount;
                } elseif ($req->tnx_type == 2) {
                    $finalDues = $preDues + $req->tnx_amount;
                    $account->ac_balance = $account->ac_balance - $req->tnx_amount;
                }
                $account->save();
                UserTransaction::create([
                    'tnx_user_id' => $req->tnx_user_id,
                    'tnx_user_name' => $username,
                    'tnx_user_type' => $req->tnx_user_type,
                    'tnx_date' => $req->tnx_date,
                    'tnx_amount' => $req->tnx_amount,
                    'tnx_type' => $req->tnx_type,
                    'tnx_final_dues' => $finalDues,
                    'tnx_account' => $req->tnx_account,
                    'tnx_remark' => $req->tnx_remark,
                    'tnx_closing_ac_bal' => $account->ac_balance
                ]);
                if ($req->tnx_user_type == 1) {
                    $user->c_dues = $finalDues;
                } else if ($req->tnx_user_type == 2) {
                    $user->p_dues = $finalDues;
                }
                $user->save();
                return response()->json(true);
            } else {
                return response()->json(['message' => 'Selected account is no more available for transactions!'], 400);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function viewAccount($id)
    {
        if (Session::has('admin')) {
            // $transactionsQuery = Transaction::where('t_ac_id', '=', $id)
            //     ->select('t_id', 't_ac_id', 't_date as tnx_date', 't_type', 't_amount', 't_final_amount', 't_remarks', 'created_at', 'updated_at');
            // $userTransactionsQuery = UserTransaction::where('tnx_account', '=', $id)
            //     ->select('tnx_id as t_id', 'tnx_account as t_ac_id', 'tnx_date', 'tnx_type as t_type', 'tnx_user_name', 'tnx_amount as t_amount', 'tnx_closing_ac_bal as t_final_amount', 'tnx_remark as t_remarks', 'created_at', 'updated_at', 'tnx_p_amount', 'tnx_user_type');
            $transactionsQuery = Transaction::where('t_ac_id', '=', $id)
                ->select('t_id', 't_ac_id', 't_date as tnx_date', 't_type', 't_amount', 't_final_amount', 't_remarks', 'created_at', 'updated_at');
            $userTransactionsQuery = UserTransaction::where('tnx_account', '=', $id)
                ->select('tnx_id as t_id', 'tnx_account as t_ac_id', 'tnx_date', 'tnx_user_name', 'tnx_type as t_type', 'tnx_amount as t_amount', 'tnx_closing_ac_bal as t_final_amount', 'tnx_remark as t_remarks', 'created_at', 'updated_at');
            $transactions = $transactionsQuery->get();
            $userTransactions = $userTransactionsQuery->get();
            $account = Account::find($id);
            $mergedTransactions = $transactions->concat($userTransactions);
            $mergedTransactions = $mergedTransactions->sortBy(function ($transaction) {
                return $transaction['created_at'] ?? $transaction['created_at'];
            });

            return view('account-view', compact('mergedTransactions', 'account'));
        } else {
            echo view('login');
        }
    }


    public function deleteTransactionAJAX(Request $req)
    {
        if (Session::has('admin')) {
            if ($req->table == 1) {
                $transaction = Transaction::find($req->id);
            } else if ($req->table == 2) {
                $transaction = UserTransaction::find($req->id);
            } else {
                return response()->json('Message from unknown table!');
            }
            if ($transaction) {
                $transaction->delete();
                return response()->json(true);
            } else {
                return response()->json('Record not found!');
            }
        } else {
            return response()->json(['message', 'You should reload the page now!'], 400);
        }
    }

    public function deletePartyDataAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $party = PartyModel::find($req->p_id);
            if ($party) {
                $party->delete();
                return response()->json(true);
            } else {
                return response()->json('Record not found!');
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchPartyInfoAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $party = PartyModel::find($req->p_id);
            return response()->json($party);
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function viewPartyTransactions($id)
    {
        if (Session::has('admin')) {
            $party = PartyModel::find($id);
            $transactions = UserTransaction::where('tnx_user_id', '=', $id)->where('tnx_user_type', '=', 2)->get();
            if (Session::has('userType')) {
                Session::pull('userType');
            }
            return view('party-transaction-view', compact('party', 'transactions'));
        } else {
            echo view('login');
        }
    }

    public function viewCustomerTransactions($id)
    {
        if (Session::has('admin')) {
            $customer = CustomerModel::find($id);
            $transactions = UserTransaction::where('tnx_user_id', '=', $id)->where('tnx_user_type', '=', 1)->get();
            if (Session::has('userType')) {
                Session::pull('userType');
            }
            return view('customer-transaction-view', compact('customer', 'transactions'));
        } else {
            echo view('login');
        }
    }

    public function updateCustomerAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $c_id = $req->c_id;
            $customer = CustomerModel::find($c_id);
            if ($customer) {
                $customer->c_name = $req->c_name;
                $customer->c_fmob = $req->c_fmob;
                $customer->c_smob = $req->c_smob;
                $customer->c_type = $req->c_type;
                $customer->c_gst = $req->c_gst;
                $customer->c_state = $req->c_state;
                $customer->c_add = $req->c_add;
                $customer->c_desc = $req->c_desc;
                $customer->save();
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function fetchCustomerInfoAJAX(Request $req)
    {
        if (Session::has('admin')) {
            return CustomerModel::find($req->id);
        } else {
            return response()->json(['message' => 'You shoule reload the page now!'], 400);
        }
    }

    public function salesTransactionsAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $history = SalesHistory::where('s_h_otp', '=', $req->s_h_otp)->first();
            if ($history) {
                $user = CustomerModel::find($history->s_h_customer_id);
                $items = SalesItems::where('s_i_s_h_id', '=', $history->s_h_id)->get();
                if ($history->s_h_paid > 0) {
                    $acc = Account::find($req->tnx_account);
                    $newAccBalance = (int)$acc->ac_balance + (int)$req->s_h_paid;
                    $acc->ac_balance = $newAccBalance;
                    $acc->save();

                    $tnx_amount = $req->s_h_paid;
                    $tnx_type = 1;
                    $tnx_account = $req->tnx_account;
                    $tnx_user_type = 1;
                    $tnx_user_id = $user->c_id;
                    if ($history->s_h_bill_desc == '') {
                        $tnx_remark = $history->s_h_bill_no . ', No description';
                    } else {
                        $tnx_remark = $history->s_h_bill_no . ', ' . $history->s_h_bill_desc;
                    }
                    $tnx_final_dues = $user->c_dues;
                    $tnx_closing_ac_bal = $newAccBalance;
                    $tnx_invoice = $history->s_h_id;
                    $tnx_date = $history->s_h_bill_date;

                    UserTransaction::create([
                        'tnx_user_id' => $tnx_user_id,
                        'tnx_user_name' => $user->c_name,
                        'tnx_user_type' => $tnx_user_type,
                        'tnx_date' => $tnx_date,
                        'tnx_amount' => $tnx_amount,
                        'tnx_type' => $tnx_type,
                        'tnx_final_dues' => $tnx_final_dues,
                        'tnx_account' => $tnx_account,
                        'tnx_remark' => $tnx_remark,
                        'tnx_closing_ac_bal' => $tnx_closing_ac_bal,
                        'tnx_invoice' => $tnx_invoice
                    ]);
                    return response()->json(true);
                } else {
                    return response()->json(true);
                }
            } else {
                return response()->json(['message' => 'You shoule reload the page now!'], 400);
            }
        } else {
            return response()->json(['message' => 'You shoule reload the page now!'], 400);
        }
    }

    public function fetchUserTransactions(Request $req, $user)
    {
        if (Session::has('admin')) {
            if ($user == 'customer') {
                $usr = CustomerModel::find($req->id);
                $type = 1;
            } elseif ($user == 'party') {
                $usr = PartyModel::find($req->id);
                $type = 2;
            }
            if ($usr) {
                $transactions = UserTransaction::where('tnx_user_id', '=', $req->id)->where('tnx_user_type', '=', $type)->get();
                return response()->json(['tnx' => $transactions, 'user' => $usr]);
            }
        } else {
            return response()->json(['message' => 'You shoule reload the page now!'], 400);
        }
    }

    public function fetchPartiesInfoAJAX(Request $req)
    {
        return response()->json(PartyModel::find($req->id));
    }

    public function updatePartyAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $party = PartyModel::find($req->p_id);
            // return response()->json($party);
            if ($party) {
                $party->update([
                    'p_name' => $req->p_name,
                    'p_type' => $req->p_type,
                    'p_fmob' => $req->p_fmob,
                    'p_smob' => $req->p_smob,
                    'p_gst' => $req->p_gst,
                    'p_state' => $req->p_state,
                    'p_add' => $req->p_add,
                    'p_desc' => $req->p_desc
                ]);
                return response()->json(true);
            }
        } else {
            return response()->json(['message' => 'You should reload the page now!'], 400);
        }
    }

    public function stockAlertAJAX()
    {
        $items = ItemsModel::where('item_min_stock', '>', DB::raw('items.item_stock_whole'))
            ->orWhere('item_min_stock', '=', DB::raw('items.item_stock_whole'))->orWhere('item_exp_date', '<=', date('Y-m-d'))
            ->count();
        return response()->json($items);
    }

    public function stockAlertPageAJAX()
    {
        return view('alert_page');
    }

    public function fetchAlertItemsAJAX()
    {
        $items = ItemsModel::where('item_min_stock', '>', DB::raw('items.item_stock_whole'))
            ->orWhere('item_min_stock', '=', DB::raw('items.item_stock_whole'))->orWhere('item_exp_date', '<=', date('Y-m-d'))
            ->get();
        return response()->json($items);
    }

    public function filterAccountStatementsAJAX(Request $req)
    {
        if (Session::has('admin')) {
            $transactionsQuery = Transaction::where('t_ac_id', '=', $req->ac_id)
                ->select('t_id', 't_ac_id', 't_date as tnx_date', 't_type', 't_amount', 't_final_amount', 't_remarks', 'created_at', 'updated_at');
            $userTransactionsQuery = UserTransaction::where('tnx_account', '=', $req->ac_id)
                ->select('tnx_id as t_id', 'tnx_account as t_ac_id', 'tnx_date', 'tnx_user_name', 'tnx_type as t_type', 'tnx_amount as t_amount', 'tnx_closing_ac_bal as t_final_amount', 'tnx_remark as t_remarks', 'created_at', 'updated_at');
            if ($req->from_date) {
                $transactionsQuery->whereDate('t_date', '>=', $req->from_date);
                $userTransactionsQuery->whereDate('tnx_date', '>=', $req->from_date);
            }
            if ($req->to_date) {
                $transactionsQuery->whereDate('t_date', '<=', $req->to_date);
                $userTransactionsQuery->whereDate('tnx_date', '<=', $req->to_date);
            }
            $transactions = $transactionsQuery->get();
            $userTransactions = $userTransactionsQuery->get();
            $account = Account::find($req->ac_id);
            $mergedTransactions = $transactions->concat($userTransactions);
            $mergedTransactions = $mergedTransactions->sortBy(function ($transaction) {
                return $transaction['created_at'] ?? $transaction['created_at'];
            });
            // return response()->json($mergedTransactions);
            return view('account-statement', compact('mergedTransactions', 'account'));
        } else {
            return redirect('/');
        }
    }

    public function filterPartyStatementsAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $from_date = $request->input('from_date');
            $to_date = $request->input('to_date');
            $from_date = $from_date ? Carbon::parse($from_date)->format('Y-m-d') : null;
            $to_date = $to_date ? Carbon::parse($to_date)->format('Y-m-d') : null;
            $userTransactionsQuery = UserTransaction::where('tnx_user_id', '=', $request->p_id)
                ->where('tnx_user_type', '=', $request->user_type);
            if ($from_date) {
                $userTransactionsQuery->whereDate('tnx_date', '>=', $from_date);
            }
            if ($to_date) {
                $userTransactionsQuery->whereDate('tnx_date', '<=', $to_date);
            }
            $userTransactions = $userTransactionsQuery->get();
            $userTransactions = $userTransactions->sortBy(function ($transaction) {
                return $transaction['created_at'] ?? $transaction['created_at'];
            });
            if ($request->user_type == 1) {
                $user = CustomerModel::find($request->p_id);
                Session::put('userType', 'customer');
            } elseif ($request->user_type == 2) {
                $user = PartyModel::find($request->p_id);
                Session::put('userType', 'party');
            }
            // return response()->json($user);
            return view('party-statement', compact('userTransactions', 'user', 'from_date', 'to_date'));
        } else {
            return redirect('/');
        }
    }

    public function filterAccountListAJAX(Request $request)
    {
        $ac_id = $request->input('ac_id');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // Convert to Carbon instances
        $from_date = $from_date ? Carbon::parse($from_date)->format('Y-m-d') : null;
        $to_date = $to_date ? Carbon::parse($to_date)->format('Y-m-d') : null;

        $transactionsQuery = Transaction::where('t_ac_id', '=', $request->ac_id)
            ->select('t_id', 't_ac_id', 't_date as tnx_date', 't_type', 't_amount', 't_final_amount', 't_remarks', 'created_at', 'updated_at');
        $userTransactionsQuery = UserTransaction::where('tnx_account', '=', $request->ac_id)
            ->select('tnx_id as t_id', 'tnx_account as t_ac_id', 'tnx_date', 'tnx_user_name', 'tnx_type as t_type', 'tnx_amount as t_amount', 'tnx_closing_ac_bal as t_final_amount', 'tnx_remark as t_remarks', 'created_at', 'updated_at');
        if ($from_date) {
            $transactionsQuery->whereDate('t_date', '>=', $from_date);
            $userTransactionsQuery->whereDate('tnx_date', '>=', $from_date);
        }
        if ($to_date) {
            $transactionsQuery->whereDate('t_date', '<=', $to_date);
            $userTransactionsQuery->whereDate('tnx_date', '<=', $to_date);
        }
        $transactions = $transactionsQuery->get();
        $userTransactions = $userTransactionsQuery->get();
        $account = Account::find($request->ac_id);
        $mergedTransactions = $transactions->concat($userTransactions);
        $mergedTransactions = $mergedTransactions->sortBy(function ($transaction) {
            return $transaction['created_at'] ?? $transaction['created_at'];
        });
        return response()->json($mergedTransactions);
    }

    public function filterUserTransactionListAJAX(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $from_date = $from_date ? Carbon::parse($from_date)->format('Y-m-d') : null;
        $to_date = $to_date ? Carbon::parse($to_date)->format('Y-m-d') : null;
        $userTransactionsQuery = UserTransaction::where('tnx_user_id', '=', $request->p_id)
            ->where('tnx_user_type', '=', $request->user_type);
        if ($from_date) {
            $userTransactionsQuery->whereDate('tnx_date', '>=', $from_date);
        }
        if ($to_date) {
            $userTransactionsQuery->whereDate('tnx_date', '<=', $to_date);
        }
        $userTransactions = $userTransactionsQuery->get();
        $userTransactions = $userTransactions->sortBy(function ($transaction) {
            return $transaction['created_at'] ?? $transaction['created_at'];
        });
        return response()->json($userTransactions);
    }

    public function generateUserStatementWPLinkAJAX(Request $request)
    {
        if (Session::has('admin')) {
            $from_date = $request->input('from_date');
            $to_date = $request->input('to_date');
            $from_date = $from_date ? Carbon::parse($from_date)->format('Y-m-d') : null;
            $to_date = $to_date ? Carbon::parse($to_date)->format('Y-m-d') : null;
            $userTransactionsQuery = UserTransaction::where('tnx_user_id', '=', $request->p_id)
                ->where('tnx_user_type', '=', $request->user_type);
            if ($from_date) {
                $userTransactionsQuery->whereDate('tnx_date', '>=', $from_date);
            }
            if ($to_date) {
                $userTransactionsQuery->whereDate('tnx_date', '<=', $to_date);
            }
            $userTransactions = $userTransactionsQuery->get();
            $userTransactions = $userTransactions->sortBy(function ($transaction) {
                return $transaction['created_at'] ?? $transaction['created_at'];
            });
            if ($request->user_type == 1) {
                $user = CustomerModel::find($request->p_id);
            } else {
                $user = PartyModel::find($request->p_id);
            }

            return response()->json(['transactions' => $userTransactions, 'from_date' => $from_date, 'to_date' => $to_date, 'user' => $user, 'status' => true]);
        } else {
        }
    }

    public function printReport(Request $request, $type)
    {
        if (Session::has('admin')) {
            $for = 0;
            if ($type == 'purchase') {
                $for = 1;
                $history = PurchaseHistory::where('p_h_bill_date', '!=', NULL);
            } elseif ($type == 'sales') {
                $for = 2;
                $history = SalesHistory::where('s_h_bill_date', '!=', NULL);
            } else {
                if ($request->type == 1) {
                    return redirect()->back();
                } elseif ($request->type == 2) {
                    return response()->json(['message' => 'Invalid route invoked!'], 400);
                } else {
                    return response()->json(['message' => 'Something went wrong!'], 400);
                }
            }
            $from_date = $request->input('from_date');
            $to_date = $request->input('to_date');
            $from_date = $from_date ? Carbon::parse($from_date)->format('Y-m-d') : null;
            $to_date = $to_date ? Carbon::parse($to_date)->format('Y-m-d') : null;
            $histories = [];
            if ($type == 'purchase') {
                if ($from_date != null) {
                    $history->whereDate('p_h_bill_date', '>=', $from_date);
                }
                if ($to_date != null) {
                    $history->whereDate('p_h_bill_date', '<=', $to_date);
                }
            } elseif ($type == 'sales') {
                if ($from_date != null) {
                    $history->whereDate('s_h_bill_date', '>=', $from_date);
                }
                if ($to_date != null) {
                    $history->whereDate('s_h_bill_date', '<=', $to_date);
                }
            }
            $histories = $history->get();
            $data = [];
            foreach ($histories as $histo) {
                $temp = [];
                if ($type == 'purchase') {
                    $party = PartyModel::find($histo->p_h_party_id);
                    $histoItems = PurchaseItem::where('p_i_p_h_id', '=', $histo->p_h_id)->get();
                    foreach ($histoItems as $item) {
                        $product = ItemsModel::find($item->p_i_item_id);
                        if ($product) {
                            if ($product->item_gst == 1) {
                                $item['gst'] = $product->item_gst_slab;
                                $temp['item'][] = $item->toArray();
                            }else{
                                continue;
                            }
                        }
                    }
                    $states = StateModel::find($party->p_state);
                    $temp['p_name'] = $party->p_name;
                    $temp['p_gst'] = $party->p_gst;
                    $temp['p_state'] = $party->p_state;
                    $temp['p_state_name'] = $states->s_name;
                    array_push($data, array_merge($temp, $histo->toArray()));
                } elseif ($type == 'sales') {
                    $customer = CustomerModel::find($histo->s_h_customer_id);
                    $histoItems = SalesItems::where('s_i_s_h_id', '=', $histo->s_h_id)->get();
                    foreach ($histoItems as $item) {
                        $product = ItemsModel::find($item->s_i_item_id);
                        if ($product) {
                            if ($product->item_gst == 1) {
                                $item['gst'] = $product->item_gst_slab;
                                $temp['item'][] = $item->toArray();
                            }else{
                                continue;
                            }
                        }
                    }
                    $states = StateModel::find($customer->c_state);
                    $temp['c_name'] = $customer->c_name;
                    $temp['c_gst'] = $customer->c_gst;
                    $temp['c_state'] = $customer->c_state;
                    $temp['c_state_name'] = $states->s_name;
                    array_push($data, array_merge($temp, $histo->toArray()));
                }
            }
            if ($request->type == 1) {
                return view('gst',compact('data','for'));
            } elseif ($request->type == 2) {
                return response()->json($data);
            } else {
                return response()->json(['message' => 'Something went wrong!'], 400);
            }
        } else {
            if ($request->type == 1) {
                return redirect()->back();
            } elseif ($request->type == 2) {
                return response()->json(['message' => 'Unauthorized access!'], 401);
            } else {
                return response()->json(['message' => 'Something went wrong!'], 400);
            }
        }
    }

    public function manageExpensesView(){
        if(Session::has('admin')){
            return view('manage-expenses');
        }else{
            return redirect('/');
        }
    }

    public function loadExpenseListAJAX(){
        if(Session::has('admin')){
            return response()->json(Expense::all());
        }else{
            return response()->json(['message','Login is required!'],400);
        }
    }

    public function makeExpenseAJAX(Request $request){
        if(Session::has('admin')){
            $request->validate([
                'name' => 'required|string'
            ],[
                'name.required' => 'Expense name is required!',
                'name.string' => 'Invalid expense name!'
            ]);
            $check = Expense::where('expense_name','=',$request->name)->first();
            if($check){
                return response()->json(['message','Expense already exists!'],400);
            }else{
                $result = Expense::create([
                    'expense_name' => $request->name
                ]);
                if($result){
                    return response()->json(Expense::all());
                }else{
                    return response()->json(['message' => 'Something went wrong!'],400);
                }
            }
        }
    }

    public function viewExpenseRecords($id){
        if(Session::has('admin')){
            $records = ExpenseRecord::where('e_r_for','=',$id)->get();
            return view('manage-expense-records',compact('records','id'));
        }else{
            return redirect('/');
        }
    }

    public function deleteExpenseAJAX(Request $request){
        if(Session::has('admin')){
            $data = Expense::find($request->id);
            if($data){
                $data->delete();
                return response()->json(true);
            }
            return response()->json(['message' => 'Something went wrong!'],400);
        }
    }

    public function saveNewExpenseRecord(Request $request){
        // return response()->json($request);
        if(Session::has('admin')){
            $request->validate([
                'e_amount' => 'required|numeric',
                'e_Date' => 'required|date',
                'e_account' => 'required|numeric',
                'e_remarks' => 'required|string'
            ],[
                'e_amount.required' => 'Amount can not left blank!',
                'e_amount.numeric' => 'Invalid amount entered!',
                'e_Date.required' => 'Please select a date!',
                'e_Date.date' => 'Invalid date selected!',
                'e_account.required' => 'Please select an account!',
                'e_account.numeric' => 'Invalid account selected!',
                'e_remarks.required' => 'Please write some remarks for this expense!',
                'e_remarks.string' => 'Invalid remaks entered!',
            ]);
            $expense = Expense::find($request->e_for);
            if(!$expense){
                return response()->json(['message'=>'Please reload this page!'],400);
            }
            $account = Account::find($request->e_account);
            if($account){
                $account->ac_balance = (float)$account->ac_balance - (float)$request->e_account;
                $account->save();
            }else{
                return response()->json(['message'=>'Selected account is not available on server!'],400);
            }
            
            Transaction::create([
                't_ac_id' => $account->ac_id,
                't_type' => 2,
                't_amount' => $request->e_amount,
                't_final_amount' => $account->ac_balance,
                't_remarks' => $expense->expense_name.', '.$request->e_remarks,
                't_date' => $request->e_Date,
            ]);
            
            $result = ExpenseRecord::create([
                'e_r_remark' => $request->e_remarks,
                'e_r_amount' => $request->e_amount,
                'e_r_ac_from' => $request->e_account,
                'e_r_for' => $request->e_for,
                'e_r_status' => 1
            ]);

            if($result){
                return response()->json(true);
            }else{
                return response()->json(['message'=>'Unable to save records right now!'],400);
            }
        }else{
            return response()->json(['message'=>'Please login again!'],400);
        }
    }
}
