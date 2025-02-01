import Extend from 'flarum/common/extenders';
import Discussion from 'flarum/common/models/Discussion';

export default [
new Extend.Model(Discussion)
    .attribute<boolean>('canEssential')
    .attribute<boolean>('essential'),
];
