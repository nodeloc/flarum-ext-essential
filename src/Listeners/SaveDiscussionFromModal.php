<?php

/*
 * This file is part of flarumite/simple-discussion-views.
 *
 * Copyright (c) 2020 Flarumite.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nodeloc\Essential\Listeners;

use Flarum\Discussion\Event\Saving;

class SaveDiscussionFromModal
{
    public function handle(Saving $event)
    {
        if (isset($event->data['attributes']['essential']) && $event->actor->can('canEssential', $event->discussion)) {
            /**
             * @var \Flarum\Discussion\Discussion
             */
            $discussion = $event->discussion;
            $discussion->essential = $event->data['attributes']['essential'];
        }
    }
}
