class Token{
    //check if this token is valid or not
  isValid(token){
      //to not change the token
      const payload = this.payload(token)
      if(payload){
          //to see if the token comes from the urls specified below
          //first part of then token the iss the token has three parts
          return payload.iss = "http://127.0.0.1:8000/api/auth/login || http://127.0.0.1:8000/api/auth/register" ? true : false
      }
      return false
  }

  //take the first part of the payload token by splitting each of the three parts seperated by . and decode the returned first part
  payload(token){
      const payload = token.split('.')[1]
      //decrypt the returned first part of the token
      return this.decode(payload)
  }

  decode(payload){
      return JSON.parse(atob(payload))
  }
//define our token locally

}

export default Token = new Token();