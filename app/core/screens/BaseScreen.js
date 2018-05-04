import React, { Component } from 'react';
import { ActivityIndicator, View  } from 'react-native';
import Expo from 'expo';
import { 
  Container, 
  Header, 
  Content,
  Button,
  Left,
  Icon,
  Right,
  Body,
  Title
} from 'native-base';

// App config
import Config from '../../src/config/config';
// Views
import { ListFormat } from '../views/formats/ListFormat';

export default class BaseScreen extends Component {

  constructor(props){
    super(props);
    this.state = {
      isLoading: true,
      data: this.props.data
    }
  }

  componentDidMount(){
    return fetch(Config.SERVER_URL+Config.DOCROOT_PATH+this.state.data.service_url)
      .then((response) => response.json())
      .then((responseJson) => {

        this.setState({
          isLoading: false,
          dataSource: responseJson,
        }, function(){

        });

      })
      .catch((error) =>{
        console.error(error);
      });
  }

  render() {
    if(this.state.isLoading){
      return(
        <View style={{flex: 1, padding: 20}}>
          <ActivityIndicator/>
        </View>
      )
    }

    return (
      <Container>
        <Header>
          <Left>
            <Button transparent onPress={() => this.props.navigation.navigate("DrawerOpen")}>
              <Icon name="menu" />
            </Button>
          </Left>
          <Body>
            <Title>{this.state.data.name}</Title>
          </Body>
          <Right />
        </Header>

        <Content>

          {/* View List format */}
          <ListFormat
            dataSource={this.state.dataSource}
          />

        </Content>
      </Container>
    );
  }
}
