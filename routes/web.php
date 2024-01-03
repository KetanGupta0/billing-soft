<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AdminController::class,'index']);
Route::get('/login', [AdminController::class,'login']);
Route::post('/checklogin', [AdminController::class,'checklogin']);
Route::get('/dashboard', [AdminController::class,'dashboard']);
Route::get('/purchase-entry', [AdminController::class,'purchase_entry']);
Route::get('/sales-entry', [AdminController::class,'sales_entry']);
Route::get('/purchase-entries', [AdminController::class,'purchase_entries']);
Route::get('/sales-entries', [AdminController::class,'sales_entries']);
Route::get('/manage-stock', [AdminController::class,'manage_stock']);
Route::get('/manage-customers', [AdminController::class,'khatabook']);
Route::get('/settings', [AdminController::class,'settings']);
Route::get('/reset-password', [AdminController::class,'reset_password']);
Route::post('/password-check',[AdminController::class,'passwordChek'])->name('password-check');
Route::post('/save-reset-password',[AdminController::class,'saveresetpassword'])->name('save-reset-password');
Route::get('/forgot-password',[AdminController::class,'forgotPasswordView']);
Route::get('/logout',[AdminController::class,'logoutView']);
Route::get('/add-new-shop',[AdminController::class,'addNewShopView']);
Route::get('/manage-parties',[AdminController::class,'manageUsersView']);
Route::get('/manage-accounts',[AdminController::class,'manageAccountsView']);
Route::get('/edit-purchase',[AdminController::class,'editPurchaseView']);
Route::get('/edit-sale',[AdminController::class,'editSaleView']);
Route::get('/logout', [AdminController::class,'logout']);
Route::get('/{otp}-{billfor}-{type}-invoice', [AdminController::class,'generateInvoice']);
Route::post('/save-settings', [AdminController::class,'save_settings']);
Route::post('/save-product', [AdminController::class,'save_product']);
Route::post('/get-items', [AdminController::class,'get_items']);
Route::post('/get-parties', [AdminController::class,'get_parties']);
Route::post('/get-customers', [AdminController::class,'getCustomers']);
Route::post('/edit-item', [AdminController::class,'edit_item']);
Route::post('/get-state', [AdminController::class,'get_state']);
Route::post('/edit-party', [AdminController::class,'edit_party']);
Route::post('/edit-customer', [AdminController::class,'editCustomer']);
Route::post('/delete-stock', [AdminController::class,'deleteStockAJAX']);
Route::post('/save-purchase-entry', [AdminController::class,'savePurchaseEntry']);
Route::post('/fetch-purchase-history', [AdminController::class,'fetchPurchaseHistory']);
Route::post('/delete-history-record', [AdminController::class,'deleteHistoryRecordAJAX']);
Route::post('/fetch-base-units', [AdminController::class,'fetchBaseUnitsAJAX']);
Route::post('/fetch-gst-slab', [AdminController::class,'fetchGstSlabAJAX']);
Route::post('/save-sales-items', [AdminController::class,'saveSalesItemsAJAX']);
Route::post('/fetch-item-stock', [AdminController::class,'fetchItemStockAJAX']);
Route::post('/remove-item-generate-invoice', [AdminController::class,'removeItemForGenerateInvoiceAJAX']);
Route::post('/fetch-khatabook-customers-list', [AdminController::class,'fetchKhatabookListAJAX']);
Route::post('/save-new-customer', [AdminController::class,'saveNewCustomerAJAX']);
Route::post('/fetch-purchase-entries', [AdminController::class,'fetchPurchaseEntriesAJAX']);
Route::post('/fetch-sales-entries', [AdminController::class,'fetchSalesEntriesAJAX']);
Route::post('/fetch-customers-list', [AdminController::class,'fetchcustomersListAJAX']);
Route::post('/fetch-customer-data', [AdminController::class,'fetchCustomerDataAJAX']); 
Route::post('/update-customer-data', [AdminController::class,'updateCustomerDataAJAX']); 
Route::post('/delete-customer-data', [AdminController::class,'deleteCustomerDataAJAX']); 
Route::post('/delete-party-data', [AdminController::class,'deletePartyDataAJAX']); 
Route::post('/create-new-account', [AdminController::class,'makeNewAccountAJAX']); 
Route::post('/fetch-account-info', [AdminController::class,'fetchAccountInfoAJAX']); 
Route::post('/delete-account-info', [AdminController::class,'deleteAccountInfoAJAX']); 
Route::post('/update-account-info', [AdminController::class,'updateAccountInfoAJAX']); 
Route::post('/make-txn', [AdminController::class,'makeTransactionAJAX']);
Route::post('/save-new-party', [AdminController::class,'saveNewPartyAJAX']);
Route::post('/delete-party-record', [AdminController::class,'deletePartyAJAX']);
Route::post('/fetch-items-data', [AdminController::class,'fetchItemsDataAJAX']);
Route::post('/save-sale-data', [AdminController::class,'saveSaleDataAJAX']);
Route::post('/delete-saved-sales-entry', [AdminController::class,'deleteSaleDataAJAX']);
Route::post('/fetch-stocks', [AdminController::class,'fetchStockDataAJAX']);
Route::post('/old-qty-unit', [AdminController::class,'oldQtyUnitAJAX']);
Route::post('/delete-customer-record', [AdminController::class,'deleteCustomerDataAJAX']);
Route::get('/edit-purchase-{historyId}', [AdminController::class,'editPurchaseHistoryIdAJAX']);
Route::get('/edit-sale-{historyId}', [AdminController::class,'editSaleHistoryIdAJAX']);
Route::get('/delete-purchase-history-{historyId}', [AdminController::class,'deletePurchaseHistoryIdAJAX']); 
Route::get('/fetch-accounts', [AdminController::class,'fetchAccountsInfoAJAX']);
Route::get('/fetch-parties-list', [AdminController::class,'fetchPartiesListAJAX']);
Route::get('/fetch-account-list', [AdminController::class,'fetchAccountListAJAX']);
Route::get('/account-view-{id}', [AdminController::class,'viewAccount']);
Route::post('/get-customer-record',[AdminController::class,'fetchCustomerRecordAJAX']);
Route::post('/save-user-transaction',[AdminController::class,'saveUserTransactionAJAX']);
Route::post('/delete-transaction-record',[AdminController::class,'deleteTransactionAJAX']);
Route::post('/get-party-record',[AdminController::class,'fetchPartyInfoAJAX']);
Route::get('/view-party-{id}',[AdminController::class,'viewPartyTransactions']);
Route::get('/view-customer-{id}',[AdminController::class,'viewCustomerTransactions']);
Route::get('/stock-alert',[AdminController::class,'stockAlertAJAX']);
Route::get('/stock-alert-page',[AdminController::class,'stockAlertPageAJAX']);
Route::post('/update-customer-info',[AdminController::class,'updateCustomerAJAX']);
Route::post('/update-party-info',[AdminController::class,'updatePartyAJAX']);
Route::post('/fetch-customer-info',[AdminController::class,'fetchCustomerInfoAJAX']);
Route::post('/fetch-party-info',[AdminController::class,'fetchPartiesInfoAJAX']);
Route::post('/sales-transaction',[AdminController::class,'salesTransactionsAJAX']);
Route::post('/fetch-{user}-transactions',[AdminController::class,'fetchUserTransactions']);
Route::post('/print-account-statement',[AdminController::class,'filterAccountStatementsAJAX']);
Route::post('/print-party-statement',[AdminController::class,'filterPartyStatementsAJAX']);
Route::get('/fetch-alert-items',[AdminController::class,'fetchAlertItemsAJAX']);
Route::post('/filter-account-list',[AdminController::class,'filterAccountListAJAX']);
Route::post('/filter-user-transaction-list',[AdminController::class,'filterUserTransactionListAJAX']);
Route::post('/generate-user-statement-wplink',[AdminController::class,'generateUserStatementWPLinkAJAX']);
Route::post('/print-report-{type}',[AdminController::class,'printReport']);
Route::get('/manage-expenses',[AdminController::class,'manageExpensesView']);
Route::get('/load-expense-list',[AdminController::class,'loadExpenseListAJAX']);
Route::post('/save-expense',[AdminController::class,'makeExpenseAJAX']);
Route::get('/expense-view-{id}',[AdminController::class,'viewExpenseRecords']);
Route::post('/delete-expence',[AdminController::class,'deleteExpenseAJAX']);
Route::post('/save-new-expense-record',[AdminController::class,'saveNewExpenseRecord']);
Route::post('/update-new-expense-record',[AdminController::class,'updateExpenseRecord']);
Route::post('/fetch-expense-record-data',[AdminController::class,'getExpenseRecordDataAJAX']);
Route::post('/get-all-expense-record',[AdminController::class,'fetchAllExpensesAJAX']);
Route::post('/filter-expense-record',[AdminController::class,'filterExpenseRecordAJAX']);
Route::post('/print-expense-statement',[AdminController::class,'printExpenseStatement']);
Route::post('/save-depressed-sale-record',[AdminController::class,'saveDepressedSaleRecordAJAX']);