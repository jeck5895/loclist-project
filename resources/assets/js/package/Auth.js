export default function (Vue) {
    Vue.auth = {
        setter(){
            axios.get('/api/user').then(response => {
                // console.log(response)
                var user = JSON.stringify(response.data);
                if(localStorage.getItem('_u') == null)
                localStorage.setItem('_u', user);
               //return user;
            }).catch(function(error) {
                console.log(error)
            });
        },
        getter(){
            var user  = JSON.parse(localStorage.getItem('_u'));
            //console.log(user.uid)
            if(user){
                return user;
            }
            else{
                return null;
            }
        },
        isAuthenticated(){
           if(this.getter()){
               return true;
           }
           else{
               return null;
           }
            // if(this.getAuthUser()){
            //     return true;
            // }
            // else{
            //     return this.getAuthUser();
            // }
        }

    }

    Object.defineProperties(Vue.prototype,{
        $auth:{
            get:() => {
                return Vue.auth
            }
        }
    })
}