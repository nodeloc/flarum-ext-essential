import app from 'flarum/forum/app';

import { extend } from 'flarum/common/extend';
import Badge from 'flarum/common/components/Badge';
import DiscussionList from 'flarum/forum/components/DiscussionList';
import Discussion from 'flarum/common/models/Discussion';

export default () => {
  extend(DiscussionList.prototype, 'requestParams', (params) => {
    params.include.push('essential');
  });

  extend(Discussion.prototype, 'badges', function (badges) {
    if (this.essential()) {
      badges.add(
        'essential',
        Badge.component({
          type: 'essential',
          label: app.translator.trans('nodeloc-essential.forum.tooltip.badge'),
          icon: 'fa-solid fa-star',
        }),
        5
      );
    }
  });
};
