module.exports = {
  babel: {
    // enable stage-0 features, make sure to install
    // babel-presets-stage-0
    presets: ['es2015', 'stage-0'],
    plugins: ['transform-runtime']
  }
}