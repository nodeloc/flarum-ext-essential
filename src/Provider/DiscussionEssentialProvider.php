<?php

/*
 * This file is part of flarumite/simple-discussion-views.
 *
 * Copyright (c) 2020 Flarumite.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nodeloc\Essential\Provider;

use Flarum\Foundation\AbstractServiceProvider;

class DiscussionEssentialProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->extend('flarum.forum.discussions.sortmap', function (array $map) {
            return array_merge($map, [
                'essential'   => '-essential',
            ]);
        });
    }
}
