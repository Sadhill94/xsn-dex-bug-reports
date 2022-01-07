<?php

namespace App\Repository;

use App\Models\Issue;
use Exception;

class IssuesRepository
{

    public function getById($id)
    {
        return Issue::with(['category', 'status', 'files', 'type'])
            ->get()
            ->find($id);
    }

    public function getAll()
    {
         return Issue::orderBy('created_at', 'DESC')
             ->with(['category', 'status', 'files', 'type'])
             ->get();
    }

    public function getIssuesWithCategoryAndStatusWhereNotIn($property, $arr)
    {
        return Issue::whereNotIn($property, $arr)
            ->with(['category', 'status', 'files', 'type'])
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function create($data)
    {
        $issue = new Issue();
        $issue->description = $data['description'];
        $issue->os = $data['os'] ?? null;
        $issue->version = $data['version'] ?? null;
        $issue->os_distribution = $data['os_distribution'] ?? null;
        $issue->steps_to_reproduce = $data['steps_to_reproduce'] ?? null;
        $issue->user_discord_id = $data['user_discord_id'] ?? null;
        $issue->category_id = $data['category_id'];
        $issue->extra_infos = $data['extra_infos'] ?? null;
        $issue->status_id = $data['status_id'];
        $issue->type_id = $data['type_id'];

        $issue->save();

        return Issue::find($issue->id);
    }

    public function edit($data)
    {
        $issue = Issue::find($data['id']);

        $issue->description = $data['description'];
        $issue->category_id = $data['category_id'];
        $issue->status_id = $data['status_id'];
        $issue->type_id = $data['type_id'];

        $issue->os = $data['os'] ?? null;
        $issue->os_distribution = $data['os_distribution'] ?? null;
        $issue->version = $data['version'] ?? null;

        $issue->steps_to_reproduce = $data['steps_to_reproduce'] ?? null;
        $issue->extra_infos = $data['extra_infos'] ?? null;



        $issue->user_discord_id = $data['user_discord_id'] ?? null;
        $issue->trello_ref = $data['trello_ref'] ?? null;
        $issue->github_link = $data['github_link'] ?? null;
        $issue->assignee = $data['assignee'] ?? null;

        $issue->save();

        return $issue;
    }

    public function delete($id)
    {
        $issue = Issue::findOrFail($id);

        try {
            $issue->delete();
            return 0;
        } catch(Exception $ex) {
            return 1;
        }
    }
}
