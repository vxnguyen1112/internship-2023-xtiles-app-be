<?php

namespace App\Helpers;

use App\Models\Comment;
use Illuminate\Support\Arr;

class MapData
{
    public static function mapResponse($row, $key)
    {
        $data = [
            'comment' => [
                'id' => $row->comment_id,
                'description' => $row->description,
                'created_at' => $row->comment_created_at,
                'updated_at' => $row->comment_updated_at,
                'document_id' => $row->comment_document_id,
                'content_id' => $row->comment_content_id,
                'account_id' => $row->comment_account_id
            ],
            'block' => [
                'id' => $row->block_id,
                'title' => $row->title,
                'color' => $row->color,
                'position' => $row->block_position,
                'size' => $row->size,
                'is_title_hidden' => $row->is_title_hidden,
                'page_id' => $row->block_page_id
            ],
            'content' => [
                'id' => $row->content_id,
                'name' => $row->content_name,
                'position' => $row->content_position,
                'type' => $row->type,
                'style' => $row->style,
                'store_url' => $row->store_url,
                'checked' => $row->checked,
                'block_id' => $row->content_block_id
            ],
            'account' => [
                'id' => $row->account_id,
                'name' => $row->account_name,
                'email' => $row->email,
                'avatar_url' => $row->avatar_url,
            ],
            'document' => [
                'id' => $row->document_id,
                'name' => $row->document_name,
                'is_deleted' => $row->is_deleted,
                'img_cover_url' => $row->img_cover_url,
                'img_panel_url' => $row->img_panel_url,
                'account_id' => $row->document_account_id,
                'workspace_id' => $row->document_workspace_id
            ],
            'workspaces' => [
                'id' => $row->workspace_id,
                'name' => $row->workspace_name,
                'img_url' => $row->img_url,
                'account_id' => $row->workspace_account_id
            ],
            'favourite_documents' => [
                'id' => $row->favourite_document_id,
                'document_id' => $row->favourite_document_document_id,
                'account_id' => $row->favourite_document_account_id
            ],
            'pages' => [
                'id' => $row->page_id,
                'name' => $row->page_name,
                'document_id' => $row->page_document_id
            ]
        ];
        return Arr::only($data, $key);
    }
}
