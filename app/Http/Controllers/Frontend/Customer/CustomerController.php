<?php

namespace App\Http\Controllers\Frontend\Customer;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Customer\StoreRequest;
use App\Http\Requests\Frontend\Customer\UpdateRequest;
use \Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $customers = $this->userService->searchCustomerUser($request->all());

        return view('frontend.pages.customers.index', ['customers' => $customers]);
    }

    public function create()
    {
        return view('frontend.pages.customers.create');
    }

    public function store(StoreRequest $request)
    {
        $this->userService->customerStore($request->all());

        return redirect()->route('frontend.customers.index')
            ->withFlashSuccess(__('Successfully created customer account.'));
    }

    public function edit(int $customerId)
    {
        $customer = $this->userService->getById($customerId);

        return view('frontend.pages.customers.edit', ['customer' => $customer]);
    }

    public function update(UpdateRequest $request, int $customerId)
    {
        $this->userService->customerUpdate($request->all(), $customerId);

        return redirect()->route('frontend.customers.index')
            ->withFlashSuccess(__('Successfully updated customer account.'));
    }

    public function destroy(int $customerId)
    {
        $this->userService->customerDelete($customerId);

        return redirect()->route('frontend.customers.index')->withFlashSuccess(__('Successfully deleted.'));
    }

    public function getAllCustomerInTrash(Request $request)
    {
        $customers = $this->userService->searchWithTrash($request->all());

        return view('frontend.pages.customers.trash.trash', ['customers' => $customers]);
    }

    public function restoreCustomer(int $customerId)
    {
        $customer = $this->userService->getByIdWithTrash($customerId);

        abort_if(!$customer, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->userService->restore($customer);

        return redirect()->route('frontend.customers.trash')->withFlashSuccess(__('Successfully restored.'));
    }

    public function forceDeleteCustomer(int $customerId)
    {
        $customer = $this->userService->getByIdWithTrash($customerId);

        abort_if(!$customer, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->userService->destroy($customer);

        return redirect()->route('frontend.customers.trash')->withFlashSuccess(__('Successfully deleted.'));
    }
}
