import React from "react";
import { DrawerNavigator } from "react-navigation";

// Config Screens nav
import { routeConfigs, navConfig } from './config/map/navRouteConfigs.js';
const DrawerNav = DrawerNavigator(routeConfigs, navConfig);

export default DrawerNav;
