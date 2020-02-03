<?php
namespace TheTurk\Stargazing\Listeners;

use Flarum\Frontend\Document;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Http\UrlGenerator;

class AddAssets
{
  /**
   * @var SettingsRepositoryInterface
   */
  protected $settings;

  /**
   * @var string $settingsPrefix
   */
  public $settingsPrefix = 'the-turk-stargazing-theme.';

  /**
   * LoadSettingsFromDatabase constructor
   *
   * @param SettingsRepositoryInterface $settings
   */
  public function __construct(SettingsRepositoryInterface $settings)
  {
      $this->settings = $settings;
  }

  /**
   * @param Document $document
   */
  public function __invoke(Document $document)
  {
      $this->assets($document);
  }

  private function assets(Document &$document)
  {
    // include bubbly-bg & google fonts
    $extensionFolder = '/'.substr($this->settingsPrefix, 0, -1);
    $urlGenerator = app()->make(UrlGenerator::class);
    $cssLocation = $extensionFolder.'/fonts/fonts.min.css';
    $document->css[] = $urlGenerator->to('forum')->path('assets/extensions'.$cssLocation);
    
    if ((bool)$this->settings->get($this->settingsPrefix.'enableStarsBackground', true) === true) {
      $jsLocation = $extensionFolder.'/bubbly-bg.js';
      $document->js[] = $urlGenerator->to('forum')->path('assets/extensions'.$jsLocation);

      // bubbly-bg options
      $document->foot[] = <<<'JS'
<script>
window.onload = function(e){
bubbly({
blur: 0.7,
bubbleFunc: () => `hsla(${Math.random() * 360}, 0%, 100%, ${Math.random() * 0.3})`,
bubbles: 120,
colorStart: "#181520",
colorStop: "#181520",
shadowColor: "#fff7fe",
radiusFunc:() => Math.random() * 2.5
});
}
</script>
JS;
    }
  }
}
