<?php

namespace App\Http\Controllers\Frontend\Staff;

use App\Domains\Staff\Services\StaffService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use \App\Http\Requests\Frontend\Staff\StoreRequest;
use App\Http\Requests\Frontend\Staff\UpdateRequest;

class StaffController extends Controller
{
    protected StaffService $staffService;

    public function __construct(
        StaffService $staffService
    )
    {
        $this->staffService = $staffService;
    }

    public function index(Request $request)
    {
        $staff = $this->staffService->search($request->all());

        return view('frontend.pages.staff.index', ['staff' => $staff]);
    }

    public function create()
    {
        return view('frontend.pages.staff.create');
    }

    public function store(StoreRequest $request)
    {
        $this->staffService->store($request->all());

        return redirect()->route('frontend.staff.index')
            ->withFlashSuccess(__('Successfully created employee account.'));
    }

    public function show(int $staffId)
    {
        $staff = $this->staffService->getById($staffId);

        return view('frontend.pages.staff.detail', ['staff' => $staff]);
    }

    public function edit(int $staffId)
    {
        $staff = $this->staffService->getById($staffId);

        return view('frontend.pages.staff.edit', ['staff' => $staff]);
    }

    public function update(UpdateRequest $request, int $staffId)
    {
        $staff = $this->staffService->getById($staffId);
        $this->staffService->update($request->all(), $staff);

        return redirect()->route('frontend.staff.index')->withFlashSuccess(__('Successfully updated.'));
    }

    public function destroy(int $staffId)
    {
        $staff = $this->staffService->getById($staffId);
        abort_if(!$staff, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->staffService->delete($staff);

        return redirect()->route('frontend.staff.index')->withFlashSuccess(__('Successfully deleted.'));
    }

    public function getAllStaffInTrash(Request $request)
    {
        $staff = $this->staffService->searchWithTrash($request->all());

        return view('frontend.pages.staff.trash.trash', ['staff' => $staff]);
    }

    public function showStaffInTrash(int $staffId)
    {
        $staff = $this->staffService->getByIdWithTrash($staffId);

        abort_if(!$staff, Response::HTTP_INTERNAL_SERVER_ERROR);

        return view('frontend.pages.staff.trash.detail', ['staff' => $staff]);
    }

    public function restoreStaff(int $staffId)
    {
        $staff = $this->staffService->getByIdWithTrash($staffId);

        abort_if(!$staff, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->staffService->restore($staff);

        return redirect()->route('frontend.staff.trash')->withFlashSuccess(__('Successfully restored.'));
    }

    public function forceDeleteStaff(int $staffId)
    {
        $staff = $this->staffService->getByIdWithTrash($staffId);

        abort_if(!$staff, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->staffService->forceDelete($staff);

        return redirect()->route('frontend.staff.trash')->withFlashSuccess(__('Successfully deleted.'));
    }
}
