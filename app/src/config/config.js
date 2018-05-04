const SERVER_URL = 'http://192.168.1.7'; // dev
// const SERVER_URL = 'https://my-staging-server.com'; // staging
// const SERVER URL = 'https://my-prod-server.com'; // production
const DOCROOT_PATH = '/dev/drupalreactapp/backend/web';// Not empty in DEV Mode
const SCREENS_URL = '/dev/drupalreactapp/backend/web/react_app_screens?_format=json';
const SYNC_DIR = './src/config/sync';
const MAP_DIR = './src/config/map';
const GOOGLE_API_KEY = '1234'; // dev
// const GOOGLE_API_KEY = '5678'; // staging
// const GOOGLE_API_KEY = '9101'; // production
module.exports = {
  SERVER_URL,
  DOCROOT_PATH,
  SCREENS_URL,
  GOOGLE_API_KEY,
  SYNC_DIR,
  MAP_DIR
};
