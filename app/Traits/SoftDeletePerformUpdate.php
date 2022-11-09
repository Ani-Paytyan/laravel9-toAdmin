<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SoftDeletePerformUpdate
{
    /**
     * @param Builder $query
     * @return bool
     */
    protected function performUpdate(Builder $query): bool
    {
        if ($this->fireModelEvent('updating') === false) {
            return false;
        }

        if ($this->usesTimestamps()) {
            $this->updateTimestamps();
        }

        $dirty = $this->getDirty();
        $deleted_at = $this->getDeletedAtColumn();

        // Check if 'deleted_at' is dirty and remove if it already has valid value in db.
        if($this->isDirty($deleted_at) && !(is_null($this->getOriginal($deleted_at)) xor is_null($dirty[$deleted_at]))) {
            unset($dirty[$deleted_at]);
            // Check if only dirty field is 'updated_at' and remove.
            if(count($dirty) === 1 && array_keys($dirty)[0] === self::UPDATED_AT){
                unset($dirty[self::UPDATED_AT]);
            }
        }

        if (count($dirty) > 0) {
            $this->setKeysForSaveQuery($query)->update($dirty);
            $this->syncChanges();
            $this->fireModelEvent('updated', false);
        }

        return true;
    }
}
