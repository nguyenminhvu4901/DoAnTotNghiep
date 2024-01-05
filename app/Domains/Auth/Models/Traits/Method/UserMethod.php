<?php

namespace App\Domains\Auth\Models\Traits\Method;

use Illuminate\Support\Collection;

/**
 * Trait UserMethod.
 */
trait UserMethod
{
    /**
     * @return bool
     */
    public function isMasterAdmin(): bool
    {
        return $this->id === 1;
    }

    /**
     * @return mixed
     */
    public function isAdmin(): bool
    {
        return $this->type === self::TYPE_ADMIN;
    }

    /**
     * @return mixed
     */
    public function isUser(): bool
    {
        return $this->type === self::TYPE_USER;
    }

    /**
     * @return mixed
     */
    public function hasAllAccess(): bool
    {
        return $this->isAdmin() && $this->hasRole(config('boilerplate.access.role.admin'));
    }

    /**
     * @param bool $excludeAdmin
     * @return bool
     */
    public function isRoleStaff(): bool
    {
        return $this->hasRole(self::ROLE_STAFF);
    }

        /**
     * @param bool $excludeAdmin
     * @return bool
     */
    public function isRoleCustomer(): bool
    {
        return $this->hasRole(self::ROLE_CUSTOMER);
    }

    /**
     * @param $type
     * @return bool
     */
    public function isType($type): bool
    {
        return $this->type === $type;
    }

    /**
     * @return mixed
     */
    public function canChangeEmail(): bool
    {
        return config('boilerplate.access.user.change_email');
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * @return bool
     */
    public function isSocial(): bool
    {
        return $this->provider && $this->provider_id;
    }

    /**
     * @return Collection
     */
    public function getPermissionDescriptions(): Collection
    {
        return $this->permissions->pluck('description');
    }

    /**
     * @param  bool  $size
     * @return mixed|string
     *
     * @throws \Creativeorange\Gravatar\Exceptions\InvalidEmailException
     */
    public function getAvatar($size = null)
    {
        return 'data:image/jpeg;base64,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';
        //return 'https://gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?s=' . config('boilerplate.avatar.size', $size) . '&d=mp';
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->language;
    }
}
