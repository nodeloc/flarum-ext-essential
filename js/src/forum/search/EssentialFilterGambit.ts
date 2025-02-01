import { SearchState } from 'flarum/common/utils/SearchState';

export default class EssentialFilterGambit {
  constructor(public searchState: SearchState) {}

  filter(query: string) {
    if (query.includes('essential:1')) {
      return { essential: true };
    }
    return {};
  }
}
