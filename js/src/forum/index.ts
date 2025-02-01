import app from 'flarum/forum/app';
import {extend} from 'flarum/common/extend';
import IndexPage from 'flarum/forum/components/IndexPage';
import LinkButton from 'flarum/common/components/LinkButton';
import AddModerationControl from './components/AddModerationControl';
import AddDiscussionBadge from "./components/AddDiscussionBadge";
import AddEssentialCountToUsers from "./components/AddEssentialCountToUsers";

export { default as extend } from './extend';


app.initializers.add('nodeloc-ext-essential', () => {
  AddModerationControl();
  AddDiscussionBadge();
  AddEssentialCountToUsers();
  extend(IndexPage.prototype, 'navItems', (items) => {
    items.add(
      'essential',
      LinkButton.component({
          icon: 'fas fa-star',
          href: app.route('index', { filter: { essential: '1' } }),
        },
        app.translator.trans('nodeloc-essential.forum.tooltip.badge')
      ),
      2
    );
  });
});
