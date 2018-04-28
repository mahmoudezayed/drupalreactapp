import React, { Component } from 'react';
import { ListItem, Thumbnail, Body, Text } from 'native-base';
export class ListThumbnail extends Component {
  render() {
    return (
      <ListItem>
        <Thumbnail square size={80} source={{ uri: this.props.image }} />
        <Body>
          <Text>{this.props.title}</Text>
          <Text note>{this.props.body}</Text>
        </Body>
      </ListItem>
    );
  }
}
