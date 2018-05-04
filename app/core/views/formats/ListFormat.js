import React, { Component } from 'react';
import { List, ListItem } from 'native-base';
// App config
import Config from '../../../src/config/config';
// View modes
import { ListThumbnail } from '../../../core/views/view_modes/ListThumbnail';

export class ListFormat extends Component {
  render() {
    return (
      <List
        dataArray={this.props.dataSource}
        renderRow={(item) =>
        
        <ListThumbnail 
          image={Config.SERVER_URL+item.field_image} 
          title={item.title}
          body={item.body}
        />

      }>
      </List>
    );
  }
}
