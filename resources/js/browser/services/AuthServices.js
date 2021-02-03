import Axios from "axios";

export default class AuthServices {
  static loggedIn (){
    return localStorage.getItem('access_token') ?? null;
  }

  // static login(email, password){
  //   Axios.post(route('browser.api.login'), {
  //     email: email,
  //     password: password,
  //   }).then((response) => {
  //     localStorage.setItem('access_token', response.data.access_token);
  //     console.log(response);
  //   }).catch((error) => console.log(error.response));
  // }

  // static logout(){
  //   Axios.get(route('browser.api.logout'), {
  //     headers: {
  //       'Authorization': `Bearer ${localStorage.getItem('access_token')}`
  //     }
  //   }).then((response) => {
  //     localStorage.removeItem('access_token');
  //     console.log(response);
  //     $router.push('/login');
  //   }).catch((error) => {});
  // }
}