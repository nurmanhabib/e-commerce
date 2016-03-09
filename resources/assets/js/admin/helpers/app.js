module.exports = {
    _app: null,

    setApp(app) {
        this._app = app;
    },

    getApp() {
        return this._app;
    },

    hasApp() {
        return this._app !== null;
    },

    http() {
        return this.getApp().$http;
    }
}