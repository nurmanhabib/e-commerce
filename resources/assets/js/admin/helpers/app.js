module.exports = {
    _app: null,

    setApp(app) {
        console.log('setapp')
        this._app = app;
    },

    getApp() {
        console.log('getapp')
        return this._app;
    },

    http() {
        return this.getApp().$http;
    },

    hasApp() {
        return this._app !== null;
    },
}