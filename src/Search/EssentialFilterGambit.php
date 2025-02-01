<?php
namespace Nodeloc\Essential\Search;

use Flarum\Filter\FilterInterface;
use Flarum\Filter\FilterState;
use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\SearchState;
use Illuminate\Database\Eloquent\Builder;

class EssentialFilterGambit extends AbstractRegexGambit implements FilterInterface
{
    /**
     * 获取过滤器键名
     */
    public function getFilterKey(): string
    {
        return 'essential';
    }

    /**
     * 定义搜索匹配模式
     */
    protected function getGambitPattern(): string
    {
        return 'is:essential';
    }

    /**
     * 处理 API 过滤 `filter[essential]=1`
     */
    public function filter(FilterState $filterState, string $filterValue, bool $negate)
    {
        $query = $filterState->getQuery();

        if ($negate) {
            $query->where('essential', false);
        } else {
            $query->where('essential', true);
        }
    }

    /**
     * 处理 `is:essential` 搜索语法
     */
    protected function conditions(SearchState $search, array $matches, $negate)
    {
        $this->filter($search, '1', $negate);
    }
}
