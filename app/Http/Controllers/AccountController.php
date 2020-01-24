<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\AccountRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Account;
use App\Models\AccountHistory;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Else_;
use Response;

class AccountController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accounts = $this->accountRepository->all();

        return view('accounts.index')
            ->with('accounts', $accounts);
    }

    public function apply_for_payout(Request $request){

        /**
         * Recieve Account id
         * Check if loggedin user is the same as owner of account
         * update applied for payout filed in account table
         * show success message
         * Update acoount history
         * Redirect and display success message
         */
        $account = $this->accountRepository->find($request->input('apply_for_payout'));

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect()->back();
        }

        if(Auth::user()->id != $account->user_id){
            Flash::error('You cannot perform this operation on an external account');

            return redirect()->back();
        }

        Account::where('id', $account->id)->update([

            'applied_for_payout'=>1,
            'paid'=>0,
            'last_date_applied' => date()
            
        ]);

        
        AccountHistory::create([
            'user_id' => Auth::user()->id,
            'account_id' => $account->id,
            'message'=>'Payout request initiated by account owner'
           
            
        ]);

        Flash::success('Application Submitted successfully');

        return redirect()->back();
    }


    public function mark_as_paid(Request $request){

        
        /**
         * Receive account id
         * Check if logged in user is an admin or moderator
         * Update applied for payout field in accounts table to 0
         * Update paid field in accounts table to 1
         * Update account history
         * Show success message
         * Redirect and display success message
         */


        $account = $this->accountRepository->find($request->input('mark_as_paid'));

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect()->back();
        }

        if(Auth::user()->role_id > 2){
            Flash::error('You cannot perform this operation if you are not an admin');

            return redirect()->back();
        }

        Account::where('id',$account->id)->update([
            'applied_for_payout'=>0,
            'paid' => 1,
            'last_date_paid' => date()
            ]);
            AccountHistory::create([
                'user_id' => $account->user_id,
                'account_id' => $account->id,
                'message'=>'Payment completed by admin:'.Auth::user()->id
            ]);

        Flash::success('Application Submitted successfully');

        return redirect()->back();
        

    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        Flash::success('Account saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id = null)
    {
        if(!isset($id)){
            $account = Account::where('user_id', Auth::user()->id)->first();
    
        }else{
            $account = $this->accountRepository->find($id);

        }
       

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $accountHistories = $account->account_histories;
        return view('accounts.show')
         ->with('accountHistories', $accountHistories)
        ->with('account', $account);
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param int $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $account = $this->accountRepository->update($request->all(), $id);

        Flash::success('Account updated successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success('Account deleted successfully.');

        return redirect(route('accounts.index'));
    }
}
