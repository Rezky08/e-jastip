<?php

namespace App\Http\Controllers\Sprinter\Config;

use App\Http\Controllers\Controller;
use App\Jobs\Master\Sprinter\UpdateOrCreateSprinterDetail;
use App\Models\Master\Sprinter\Sprinter;
use App\Supports\FormSupport;
use App\Supports\Notification\ToastSupport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @var Sprinter $user */
        $user = $this->authRepository->getUser();
        $form = [
            'name' => $user->detail->name ?? $user->name,
            'phone' => $user->detail->phone ?? null
        ];
        FormSupport::storeFormData($form);
        return view('components.sprinter.config.general.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Sprinter $user */
        $user = $this->authRepository->getUser();
        $job = new UpdateOrCreateSprinterDetail($request->all(), $user);
        DB::transaction(function () use (&$job) {
            try {
                $this->dispatch($job);
            } catch (\Exception $exception) {
                ToastSupport::add($exception->getMessage(), __('messages.title.config.general'));
                throw $exception;
            }
        });
        $user = $job->sprinter;
        ToastSupport::add(__('messages.notification.submit.success', ['title' => 'Update Config', 'id' => $user->name]), __('messages.title.config.general'));
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
