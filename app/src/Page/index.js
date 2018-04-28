import React, { Component } from "react";
import Page from "./Page.js";
import { StackNavigator } from "react-navigation";
export default (DrawNav = StackNavigator(
  {
    Page: { screen: Page }
  },
  {
    initialRouteName: "Page"
  }
));
