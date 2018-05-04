fs = require('fs');
const Config = require("../../src/config/config");
const Screens = require('../../src/config/sync/screens.json');

// Map Nav
let navConfigsText = '';
navConfigsText += 'import React from "react";\r\n';
navConfigsText += 'import BaseScreen from "../../../core/screens/BaseScreen.js";\r\n';
navConfigsText += '\r\n';

navConfigsText += 'export const routeConfigs = {\r\n';
// Loop through screens
Screens.forEach(function(screen) {
  navConfigsText += ''+screen.name.replace(/\s/g, "")+': { screen: (props) => <BaseScreen {...props} data={'+JSON.stringify(screen)+'} />,\r\n';
  navConfigsText += 'navigationOptions: {  title: "'+screen.name+'" }\r\n';
  navConfigsText += '},\r\n';
});
// End Loop through screens.
navConfigsText += '};\r\n';
navConfigsText += '\r\n';

navConfigsText += 'export const navConfig = {\r\n';
navConfigsText += 'initialRouteName: "Nodes",\r\n';
navConfigsText += 'drawerPosition: "left"\r\n';
navConfigsText += '};';
navConfigsText += '\r\n';

fs.writeFile(Config.MAP_DIR+'/navRouteConfigs.js', navConfigsText, function (err) {
  if (err) return console.log(err);
  console.log('Config "navRouteConfigText" mapped successfully');
});
