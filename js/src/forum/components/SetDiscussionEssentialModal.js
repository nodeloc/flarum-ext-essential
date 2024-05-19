import app from 'flarum/forum/app';
import Modal from 'flarum/common/components/Modal';
import Button from 'flarum/common/components/Button';
import Stream from 'flarum/common/utils/Stream';
import Switch from 'flarum/common/components/Switch';

export default class SetDiscussionEssentialModal extends Modal {
  oninit(vnode) {
    super.oninit(vnode);
    this.discussion = this.attrs.discussion;
    this.currentEssential = this.attrs.discussion.essential();
    this.isEssential = Stream(this.currentEssential);
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form Form--centered">
          <div className="Form-group">
            <Switch state={this.isEssential()} onchange={this.isEssential}>
              {app.translator.trans('nodeloc-essential.forum.modal_set_essential.is_essential')}
            </Switch>
          </div>
          <div className="Form-group">
            <Button className="Button Button--primary" type="submit" loading={this.loading}>
              {app.translator.trans('nodeloc-essential.forum.modal_set_essential.submit')}
            </Button>
          </div>
        </div>
      </div>
    );
  }

  title() {
    return app.translator.trans('nodeloc-essential.forum.modal_set_essential.title');
  }

  className() {
    return 'Modal--small';
  }

  onsubmit(e) {
    e.preventDefault();
    this.loading = true;

    const newEssential = this.isEssential();

    if (newEssential !== this.currentEssential) {
      this.attrs.discussion
        .save({ essential: newEssential })
        .then(() => {
          m.redraw();
        })
        .catch((reason) => {
          this.loading = false;
          console.warn(reason);
        });
    }

    this.hide();
  }
}
