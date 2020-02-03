import app from 'flarum/app';
import SettingsModal from 'flarum/components/SettingsModal';
import Switch from 'flarum/components/Switch';

// just to make things easier
const settingsPrefix = 'the-turk-stargazing-theme.';
const translationPrefix = 'the-turk-stargazing-theme.admin.settings.';

export default class StargazingSettingsModal extends SettingsModal {
  title() {
    return app.translator.trans(translationPrefix + 'title');
  }

  /**
   * Build modal form.
   *
   * @returns {*}
   */
  form() {
    return [
      m('.Form-group', [
        m('label', Switch.component({
          state: this.setting(settingsPrefix + 'relocateSidebar', '1')() === '1',
          children: app.translator.trans(translationPrefix + 'relocateSidebar'),
          onchange: value => {
            this.setting(settingsPrefix + 'relocateSidebar')(value ? '1' : '0');
          }
        }))
      ]),
      m('.Form-group', [
        m('label', Switch.component({
          state: this.setting(settingsPrefix + 'enableStarsBackground', '1')() === '1',
          children: app.translator.trans(translationPrefix + 'enableStarsBackground'),
          onchange: value => {
            this.setting(settingsPrefix + 'enableStarsBackground')(value ? '1' : '0');
          }
        }))
      ]),
    ];
  }
}
