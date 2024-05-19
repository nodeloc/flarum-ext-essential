import app from 'flarum/forum/app';
import AddPopularSort from './components/AddEssentialSort';
import AddModerationControl from './components/AddModerationControl';
import AddDiscussionBadge from "./components/AddDiscussionBadge";

export { default as extend } from './extend';

app.initializers.add('nodeloc-ext-essential', () => {
  AddPopularSort();
  AddModerationControl();
  AddDiscussionBadge();
});
