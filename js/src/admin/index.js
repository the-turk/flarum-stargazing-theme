import app from 'flarum/app';
import StargazingSettingsModal from "./modals/StargazingSettingsModal";

// initialize settings modal
app.initializers.add('the-turk-stargazing-theme', app => {
  app.extensionSettings['the-turk-stargazing-theme'] =
    () => app.modal.show(new StargazingSettingsModal());
});
