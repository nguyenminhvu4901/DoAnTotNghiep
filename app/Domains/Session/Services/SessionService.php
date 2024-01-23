<?php

namespace App\Domains\Session\Services;

use App\Domains\Event\Models\Event;
use App\Domains\Session\Models\Session;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class EventService.
 */
class SessionService extends BaseService
{
    /**
     * @var Session
     */
    protected Session $session;

    /**
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->model = $session;
    }

    /**
     * Remove all sessions of a user
     *
     * @param int $user_id
     * @return void
     */
    public function removeUserSession(int $user_id): void
    {
        $this->model->where('user_id', $user_id)->delete();
    }
}
