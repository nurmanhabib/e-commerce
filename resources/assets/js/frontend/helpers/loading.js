var event = require('./event.js');

module.exports = {
    _app: null,

    setApp(app) {
        this._app = app;

        event.setApp(app);
    },

    getApp() {
        return this._app;
    },

    hasApp() {
        return this._app !== null;
    },

    show(timeout) {
        if (this.hasApp()) {
            event.fire('loading.show', timeout);
        }
    },

    hide() {
        if (this.hasApp()) {
            event.fire('loading.hide');
        }
    }
}