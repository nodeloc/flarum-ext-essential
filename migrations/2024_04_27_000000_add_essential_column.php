<?php

/*
 * This file is part of flarumite/simple-discussion-views.
 *
 * Copyright (c) 2020 Flarumite.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasColumn('discussions', 'essential')) {
            $schema->table('discussions', function (Blueprint $table) {
                $table->boolean('essential')->default(false)->unsigned();
            });
        }
    },
    'down' => function (Builder $schema) {
        // no.
    },
];
