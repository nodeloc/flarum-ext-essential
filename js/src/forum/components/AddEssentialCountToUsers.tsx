import app from 'flarum/forum/app';
import { extend } from 'flarum/common/extend';
import Model from 'flarum/common/Model';
import User from 'flarum/common/models/User';
import ItemList from 'flarum/common/utils/ItemList';
import UserCard from 'flarum/forum/components/UserCard';
import icon from 'flarum/common/helpers/icon';

import type Mithril from 'mithril';

export default function addBestAnswerCountToUsers() {
  User.prototype.essentialCount = Model.attribute<number>('essentialCount');

  extend(UserCard.prototype, 'infoItems', function (items: ItemList<Mithril.Children>) {
    const user = this.attrs.user;

    items.add(
      'essential-count',
      <span className="UserCard-essential-count">
        {icon('fas fa-star')}
        {app.translator.trans('nodeloc-essential.forum.user.essential_count', {
          count: user.essentialCount(),
        })}
      </span>,
      55
    );
  });
}
