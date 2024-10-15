<?php

namespace App\Livewire\Proposals;

use App\Actions\ArrangePositions;
use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{

    public Project $project;

    public bool $modal = false;

    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule(['required', 'numeric', 'gt:0'])]
    public int $hours = 0;

    public bool $agree = false;

    public function save()
    {

        if (!$this->agree) {

            $this->addError('agree', 'Você precisa concordar com os termos de uso');

            return;
        }

        $this->validate();

        DB::transaction(function() {
            $proposal = $this->project->proposals()
                ->updateOrCreate(
                    ['email' => $this->email],
                    ['hours' => $this->hours]
                );

            $this->arrangePosition($proposal);
        });

        $this->dispatch('proposal::created');

        $this->modal = false;

    }

    public function arrangePosition(Proposal $proposal)
    {

        $query = DB::select("
            SELECT *, row_number() over (order by hours asc) as newPosition
            FROM proposals
            WHERE project_id = :project
        ", ['project' => $proposal->project_id]);

        $position = collect($query)->where('id', '=', $proposal->id)->first();
        $otherProposal = collect($query)->where('position', '=', $position->newPosition)->first();

        if ($otherProposal) {
            $proposal->update(['position_status' => 'up']);
            Proposal::query()->where('id', '=', $otherProposal->id)->update(['position_status' => 'down']);
        }

        ArrangePositions::run($proposal->id);
    }

    public function render()
    {
        return view('livewire.proposals.create');
    }
}
