<?php

namespace Nodeloc\Essential\Api\Controller;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Discussion\Discussion;
use Flarum\Api\Serializer\DiscussionSerializer;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListEssentialDiscussionsController extends AbstractListController
{
    public $serializer = DiscussionSerializer::class;

    protected function data(ServerRequestInterface $request, Document $document)
    {
        return Discussion::where('essential', true)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }
}
