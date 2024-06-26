<?php

/*
 * This file is part of flarumite/simple-discussion-views.
 *
 * Copyright (c) 2020 Flarumite.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nodeloc\Essential\Search;

use Flarum\Filter\FilterInterface;
use Flarum\Filter\FilterState;
use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;
use Flarum\User\User;
use Illuminate\Database\Query\Builder;

class EssentialFilterGambit extends AbstractRegexGambit implements FilterInterface
{
    /**
     * {@inheritDoc}
     */
    public function getFilterKey(): string
    {
        return 'essential';
    }

    /**
     * {@inheritDoc}
     */
    public function getGambitPattern()
    {
        return 'is:essential';
    }

    /**
     * {@inheritDoc}
     */
    public function filter(FilterState $filterState, string $filterValue, bool $negate)
    {
        $this->sort($filterState->getQuery(), $filterState->getActor(), $negate);
    }

    protected function sort(Builder $query, User $actor, bool $negate)
    {
        $query->orderBy('id', 'desc');
    }

    /**
     * @param SearchState $search
     * @param array       $matches
     * @param             $negate
     */
    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $this->sort($search->getQuery(), $search->getActor(), $negate);
    }
}
