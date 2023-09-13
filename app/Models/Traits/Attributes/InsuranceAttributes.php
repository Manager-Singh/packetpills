<?php

namespace App\Models\Traits\Attributes;

trait InsuranceAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group" role="group" aria-label="'.trans('labels.backend.access.users.user_actions').'">'.
                $this->getEditButtonAttribute('edit-insurance', 'admin.preciption-types.edit').
                $this->getDeleteButtonAttribute('delete-insurance', 'admin.preciption-types.destroy').
                '</div>';
    }

    /**
     * Get Display Status Attribute.
     *
     * @var string
     */
    public function getDisplayStatusAttribute(): string
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>".trans('labels.general.active').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.inactive').'</label>';
    }

    /**
     * Get Statuses Attribute.
     *
     * @var string
     */
    public function isActive()
    {
        return $this->status == 1;
    }
}
