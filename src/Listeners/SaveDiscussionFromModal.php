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
            $isEssential = (bool) $event->data['attributes']['essential'];
            if ($isEssential !== $discussion->essential) {
                $user = $discussion->user;
                if ($isEssential) {
                    $user->essential_count++;
                } else {
                    $user->essential_count = max(0, $user->essential_count - 1);
                }
                $user->save();
                $discussion->essential = $isEssential ;
            }
        }
    }
}
