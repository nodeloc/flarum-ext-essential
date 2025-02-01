<?php

/*
 * This file is part of flarumite/simple-discussion-views.
 *
 * Copyright (c) 2020 Flarumite.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nodeloc\Essential;

use Flarum\Api\Controller;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving;
use Flarum\Discussion\Filter\DiscussionFilterer;
use Flarum\Discussion\Search\DiscussionSearcher;
use Flarum\User;
use Flarum\Extend;
use Nodeloc\Essential\Api\Controller\ListEssentialDiscussionsController;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__.'/resources/less/forum.less')
        ->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Model(Discussion::class))
        ->cast('essential', 'boolean'),
    (new Extend\Model(User::class))
        ->cast('essential_count', 'integer'),

    (new Extend\Event())
        ->listen(Saving::class, Listeners\SaveDiscussionFromModal::class),

    (new Extend\ApiSerializer(DiscussionSerializer::class))
        ->attribute('essential', function (DiscussionSerializer $serializer, Discussion $discussion) {
            return $discussion->essential;
        })
        ->attributes(AddAttributesBasedOnPermission::class),

    (new Extend\ApiController(Controller\ListDiscussionsController::class))
        ->addSortField('essential'),
    (new Extend\Settings())
        ->serializeToForum('essentialRewardMoney', 'nodeloc-essential.rewardMoney', 'intval', 0),

    (new Extend\ServiceProvider())
        ->register(Provider\DiscussionEssentialProvider::class),

    (new Extend\SimpleFlarumSearch(DiscussionSearcher::class))
        ->addGambit(Search\EssentialFilterGambit::class),

    (new Extend\Filter(DiscussionFilterer::class))
        ->addFilter(Search\EssentialFilterGambit::class),


];
