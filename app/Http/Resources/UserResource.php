<?php

namespace App\Http\Resources;

use App\Enums\VaccinatedStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'nid' => $this->nid,
            'scheduled_at' => Carbon::parse($this->scheduled_at)->toDateString(),
            'vaccination_status' => $this->getVaccinatedStatus($this)
        ];
    }

    private function getVaccinatedStatus($resource): string
    {
        $today = Carbon::today();
        $scheduledDate = Carbon::parse($resource->scheduled_at);

        if ($today->gt($scheduledDate)) {
            return VaccinatedStatus::VACCINATED->getValue();
        }

        return VaccinatedStatus::getVaccinatedStatus($resource->vaccination_status->value);
    }
}
