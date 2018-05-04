fs = require('fs');
const fetch = require('node-fetch');
const Config = require("../../src/config/config");

// Config sync screens.
fetch(Config.SERVER_URL+Config.SCREENS_URL)
  .then((response) => response.json())
  .then((responseJson) => {
  	// Create config screens file.
    fs.writeFile(Config.SYNC_DIR+'/screens.json', JSON.stringify(responseJson), function (err) {
      if (err) return console.log(err);
      console.log('Config "screens" synced successfully');
      // Config map
      require("./config-map");
    });

  })
  .catch((error) =>{
    console.error(error);
  });
