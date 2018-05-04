import React from "react";
import BaseScreen from "../../../core/screens/BaseScreen.js";

export const routeConfigs = {
Homescreen: { screen: (props) => <BaseScreen {...props} data={{"name":"Home screen","field_view_mode":"list","service_url":"/nodes?_format=json"}} />,
navigationOptions: {  title: "Home screen" }
},
Nodes: { screen: (props) => <BaseScreen {...props} data={{"name":"Nodes","field_view_mode":"list","service_url":"/nodes?_format=json"}} />,
navigationOptions: {  title: "Nodes" }
},
News: { screen: (props) => <BaseScreen {...props} data={{"name":"News","field_view_mode":"list","service_url":"/news?_format=json"}} />,
navigationOptions: {  title: "News" }
},
};

export const navConfig = {
initialRouteName: "Nodes",
drawerPosition: "left"
};
