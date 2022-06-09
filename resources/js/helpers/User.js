import Token from './Token'
import AppStorage from './AppStorage'

class User{
    //check if the returned response by axios has any token or not or has any user name or not & storing token returned by axios response after login
    responseAfterLogin(res){
        const access_token = res.data.access_token
        const username = res.data.name
        if(Token.isValid(access_token)){
            //after checking that the token returned by axios login response is valid use the storage method in the AppStorage helper
            AppStorage.store(access_token, username)
        }
    }
    hasToken(){
        const storeToken = localStorage.getItem('token');
        if(storeToken){
            return Token.isValid(storeToken) ? true : false
        }
        false
    }
    //when this user will be logged in with appropriate token
    //this user this has token or not   
    loggedIn(){
        return this.hasToken()
    }
//when this user is logged in get appropriate name
    name(){
        if(this.loggedIn()){
            return localStorage.getItem('user');
        }
    }

    id(){
        if(this.loggedIn()){
            const payload = Token.payload(localStorage.getItem('token')); 
            //visible the returned payload
            return payload.sub
        }
        return false
    }
}

export default User = new User();