<?php


namespace App\Actions;

use Illuminate\Support\Facades\DB;

class ArrangePositions
{
    public static function run (int $id)
    {
        DB::update("
            WITH RankedProposals as (
            SELECT id, row_number() over(order by hours asc) as p
            FROM proposals
            WHERE project_id = :project
            )
            UPDATE proposals
            SET position = (SELECT p FROM RankedProposals WHERE proposals.id = RankedProposals.id)
            WHERE project_id = :project
        ", ['project' => $id]);
    }
}
