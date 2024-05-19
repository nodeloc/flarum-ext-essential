import app from 'flarum/admin/app';

app.initializers.add('nodeloc-ext-essential', () => {
  app.extensionData
    .for('nodeloc-essential')
    .registerPermission(
      {
        icon: 'far fa-eye',
        label: app.translator.trans('nodeloc-essential.admin.permissions.set_essential'),
        permission: 'discussion.canEssential',
      },
      'moderate'
    )
    .registerSetting({
      setting: 'nodeloc-essential.rewardMoney',
      type: 'number',
      label: app.translator.trans('nodeloc-essential.admin.settings.reward_money'),
    });
});
