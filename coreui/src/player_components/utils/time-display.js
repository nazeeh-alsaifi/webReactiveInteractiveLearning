/**
 *  @Nazeeh-Saifi:file from videojs repo need to be edited for our project
 * @file time-display.js
 */
import document from "global/document";
import videojs from "video.js";
import formatTime from "./format-time.js";
import formatFrame from "./format-frame.js";
/**
 * Displays time information about the video
 *
 * @extends Component
 */
class NewTimeDisplay extends videojs.getComponent("Component") {
  /**
   * Creates an instance of this class.
   *
   * @param {Player} player
   *        The `Player` that this class should be attached to.
   *
   * @param {Object} [options]
   *        The key/value store of player options.
   */
  constructor(player, options) {
    super(player, options);

    this.on(player, ["timeupdate", "ended"], this.updateContent);
    this.updateTextNode_();
  }

  /**
   * Create the `Component`'s DOM element
   *
   * @return {Element}
   *         The element that was created.
   */
  createEl() {
    const className = this.buildCSSClass();
    const el = super.createEl("div", {
      className: `${className} vjs-time-control vjs-control`,
      innerHTML: `<span class="vjs-control-text" role="presentation">${this.localize(
        this.labelText_
      )}\u00a0</span>`,
    });

    this.contentEl_ = videojs.dom.createEl(
      "span",
      {
        className: `${className}-display`,
      },
      {
        // tell screen readers not to automatically read the time as it changes
        "aria-live": "off",
        // span elements have no implicit role, but some screen readers (notably VoiceOver)
        // treat them as a break between items in the DOM when using arrow keys
        // (or left-to-right swipes on iOS) to read contents of a page. Using
        // role='presentation' causes VoiceOver to NOT treat this span as a break.
        role: "presentation",
      }
    );

    el.appendChild(this.contentEl_);
    return el;
  }

  dispose() {
    this.contentEl_ = null;
    this.textNode_ = null;

    super.dispose();
  }

  /**
   * Updates the time display text node with a new time
   *
   * @param {number} [time=0] the time to update to
   *
   * @private
   */
  updateTextNode_(time = 0) {
    time = formatTime(time);

    if (this.formattedTime_ === time) {
      return;
    }

    this.formattedTime_ = time;

    this.requestAnimationFrame(() => {
      if (!this.contentEl_) {
        return;
      }

      const oldNode = this.textNode_;

      this.textNode_ = document.createTextNode(this.formattedTime_);

      if (!this.textNode_) {
        return;
      }

      if (oldNode) {
        this.contentEl_.replaceChild(this.textNode_, oldNode);
      } else {
        this.contentEl_.appendChild(this.textNode_);
      }
    });
  }

  /**
   * To be filled out in the child class, should update the displayed time
   * in accordance with the fact that the current time has changed.
   *
   * @param {EventTarget~Event} [event]
   *        The `timeupdate`  event that caused this to run.
   *
   * @listens Player#timeupdate
   */
  updateContent() {}
}

class NewFrameDisplay extends videojs.getComponent("Component") {
  /**
   * Creates an instance of this class.
   *
   * @param {Player} player
   *        The `Player` that this class should be attached to.
   *
   * @param {Object} [options]
   *        The key/value store of player options.
   */
  constructor(player, options) {
    super(player, options);

    this.on(player, ["timeupdate", "ended"], this.updateContent);
    this.updateTextNode_();
  }

  /**
   * Create the `Component`'s DOM element
   *
   * @return {Element}
   *         The element that was created.
   */
  createEl() {
    const className = this.buildCSSClass();
    const el = super.createEl("div", {
      className: `${className} vjs-time-control vjs-control`,
      innerHTML: `<span class="vjs-control-text" role="presentation">${this.localize(
        this.labelText_
      )}\u00a0</span>`,
    });

    this.contentEl_ = videojs.dom.createEl(
      "span",
      {
        className: `${className}-display`,
      },
      {
        // tell screen readers not to automatically read the time as it changes
        "aria-live": "off",
        // span elements have no implicit role, but some screen readers (notably VoiceOver)
        // treat them as a break between items in the DOM when using arrow keys
        // (or left-to-right swipes on iOS) to read contents of a page. Using
        // role='presentation' causes VoiceOver to NOT treat this span as a break.
        role: "presentation",
      }
    );

    el.appendChild(this.contentEl_);
    return el;
  }

  dispose() {
    this.contentEl_ = null;
    this.textNode_ = null;

    super.dispose();
  }

  /**
   * Updates the time display text node with a new time
   *
   * @param {number} [time=0] the time to update to
   *
   * @private
   */
  updateTextNode_(time = 0) {
    time = formatFrame(time);

    if (this.formattedTime_ === time) {
      return;
    }

    this.formattedTime_ = time;

    this.requestAnimationFrame(() => {
      if (!this.contentEl_) {
        return;
      }

      const oldNode = this.textNode_;

      this.textNode_ = document.createTextNode(this.formattedTime_);

      if (!this.textNode_) {
        return;
      }

      if (oldNode) {
        this.contentEl_.replaceChild(this.textNode_, oldNode);
      } else {
        this.contentEl_.appendChild(this.textNode_);
      }
    });
  }

  /**
   * To be filled out in the child class, should update the displayed time
   * in accordance with the fact that the current time has changed.
   *
   * @param {EventTarget~Event} [event]
   *        The `timeupdate`  event that caused this to run.
   *
   * @listens Player#timeupdate
   */
  updateContent() {}
}

/**
 * The text that is added to the `TimeDisplay` for screen reader users.
 *
 * @type {string}
 * @private
 */
NewTimeDisplay.prototype.labelText_ = "Time";
NewFrameDisplay.prototype.labelText_ = "Frames";

/**
 * The text that should display over the `TimeDisplay`s controls. Added to for localization.
 *
 * @type {string}
 * @private
 *
 * @deprecated in v7; controlText_ is not used in non-active display Components
 */
NewTimeDisplay.prototype.controlText_ = "Time";
NewFrameDisplay.prototype.controlText_ = "Frames";

// Component.registerComponent("NewTimeDisplay", NewTimeDisplay);
export { NewTimeDisplay, NewFrameDisplay };
