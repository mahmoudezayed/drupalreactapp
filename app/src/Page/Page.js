import React, { Component } from 'react';
import { ActivityIndicator, View  } from 'react-native';
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

import Expo from 'expo';

// App config
import Config from '../../config';

// Views
import { ListFormat } from '../../core/views/formats/ListFormat';

export default class Page extends Component {

  constructor(props){
    super(props);
    this.state ={isReady: false, isLoading: true}
  }

  componentDidMount(){
    return fetch(Config.SERVER_URL+'/dev/drupalreactapp/backend/web/nodes?_format=json')
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

  async componentWillMount() {
    await Expo.Font.loadAsync({
      'Roboto': require('native-base/Fonts/Roboto.ttf'),
      'Roboto_medium': require('native-base/Fonts/Roboto_medium.ttf'),
    });
    this.setState({isReady:true})
  }

  render() {
    if (!this.state.isReady) {
      return <Expo.AppLoading />;
    }

    if(this.state.isLoading){
      return(
        <View style={{flex: 1, padding: 20}}>
          <ActivityIndicator/>
        </View>
      )
    }

    return (
      <Container>
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

Page.navigationOptions = ({ navigation }) => {
  return {
    header: (
      <Header>
        <Left>
          <Button transparent onPress={() => navigation.navigate("DrawerOpen")}>
            <Icon name="menu" />
          </Button>
        </Left>
        <Body>
          <Title>Page</Title>
        </Body>
        <Right />
      </Header>
    )
  };
};
