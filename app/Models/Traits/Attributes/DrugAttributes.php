<?php

namespace App\Models\Traits\Attributes;

trait DrugAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group" role="group" aria-label="'.trans('labels.backend.access.users.user_actions').'">'.
                $this->getEditButtonAttribute('edit-drug', 'admin.drugs.edit').
                $this->getDeleteButtonAttribute('delete-drug', 'admin.drugs.destroy').
                '</div>';
    }

    /**
     * Get Display Status Attribute.
     *
     * @var string
     */
    public function getDisplayStatusAttribute(): string
    {
       //dd($this->status);
        return $this->statuses[$this->status] ?? null;
    }

    /**
     * Get Statuses Attribute.
     *
     * @var string
     */
    public function getStatusesAttribute(): array
    {
        return $this->statuses;
    }
}
